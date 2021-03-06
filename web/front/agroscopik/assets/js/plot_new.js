(function (document, window, $) {
    'use strict';

    window.AppPlotNew = App.extend({
        createMap: function () {
            // Mapbox access token
            L.mapbox.accessToken = 'pk.eyJ1IjoiaHVnb2xlaG91eCIsImEiOiItOHl6Sm5jIn0.12l_k0K_Z28UE-Jc0kDgpw';

            // Create the map
            var map = L.mapbox.map('map', 'mapbox.streets-satellite').setView([-21.20000, 166.00000], 7);

            // Add GeoRep
            var georep = L.tileLayer.wms('https://carto10.gouv.nc/arcgis/services/fond_imagerie/MapServer/WMSServer', {
                format: 'img/png',
                transparent: true,
                layers: 16,
                maxZoom: 26
            });

            // Display GeoRep according to zoom level
            map.on('zoomend', function () {
                if (map.getZoom() > 9 && map.hasLayer(georep) == false) {
                    map.addLayer(georep);
                }
                if (map.getZoom() < 9 && map.hasLayer(georep)) {
                    map.removeLayer(georep);
                }
            });

            // Locate current user
            var lc = L.control.locate().addTo(map);
            lc.start();
            $('.leaflet-control-locate').hide();

            // Where the polygons are stored
            var featureGroup = L.featureGroup().addTo(map);

            // Change icon styles
            L.Edit.Poly = L.Edit.Poly.extend({
                options: {
                    icon: new L.DivIcon({
                        iconSize: new L.Point(20, 20),
                        className: 'leaflet-div-icon leaflet-editing-icon my-own-icon',
                        html: '<div class="inside-div"></div>'
                    })
                }
            });

            // Enable drawing polygons
            var drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: featureGroup,
                    selectedPathOptions: {
                        dashArray: "8,6",
                        color: 'white',
                        opacity: 0.8,
                        weight: 1.5
                    }
                },
                draw: {
                    polyline: false,
                    circle: false,
                    marker: false,
                    rectangle: false,
                    polygon: {
                        icon: new L.DivIcon({
                            iconSize: new L.Point(20, 20),
                            className: 'leaflet-div-icon leaflet-editing-icon my-own-icon',
                            html: '<div class="created-div"></div>'
                        }),
                        shapeOptions: {
                            dashArray: "8,6",
                            color: 'white',
                            opacity: 0.8,
                            weight: 1.5
                        }
                    }
                }
            }).addTo(map);

            // Change Leaflet draw messages
            L.drawLocal = {
                draw: {
                    toolbar: {
                        actions: {
                            title: 'Annulez le dessin',
                            text: 'Annuler'
                        },
                        buttons: {
                            polyline: 'Dessiner une polyligne',
                            polygon: 'Dessiner ma parcelle',
                            rectangle: 'Dessiner un rectangle',
                            circle: 'Dessiner un cercle',
                            marker: 'Dessiner un marqueur'
                        }
                    },
                    handlers: {
                        circle: {
                            tooltip: {
                                start: 'Cliquez et déplacez pour dessiner un cercle.'
                            }
                        },
                        marker: {
                            tooltip: {
                                start: 'Cliquez sur la carte pour placer un marqueur.'
                            }
                        },
                        polygon: {
                            tooltip: {
                                start: 'Vous pouvez commencer à dessiner votre parcelle.',
                                cont: 'Vous pouvez continuer à dessiner votre parcelle',
                                end: 'Cliquez sur votre premier point quand vous avez terminé.'
                            }
                        },
                        polyline: {
                            error: '<strong>Erreur:</strong> Les arrêtes de la forme ne doivent pas se croiser!',
                            tooltip: {
                                start: 'Cliquez pour commencer à dessiner d\'une ligne.',
                                cont: 'Cliquez pour continuer à dessiner une ligne.',
                                end: 'Cliquez sur le dernier point pour terminer la ligne.'
                            }
                        },
                        rectangle: {
                            tooltip: {
                                start: 'Cliquez et déplacez pour dessiner un rectangle.'
                            }
                        },
                        simpleshape: {
                            tooltip: {
                                end: 'Relachez la souris pour finir de dessiner.'
                            }
                        }
                    }
                },
                edit: {
                    toolbar: {
                        actions: {
                            save: {
                                title: 'Enregistrer les changements.',
                                text: 'Enregistrer'
                            },
                            cancel: {
                                title: 'Annuler les modifications.',
                                text: 'Annuler'
                            }
                        },
                        buttons: {
                            edit: 'Modifier la parcelle.',
                            editDisabled: 'Aucune parcelle à modifier.',
                            remove: 'Supprimer la parcelle.',
                            removeDisabled: 'Aucune parcelle à supprimer.'
                        }
                    },
                    handlers: {
                        edit: {
                            tooltip: {
                                text: 'Déplacez les points pour modifier la parcelle.',
                                subtext: ''
                            }
                        },
                        remove: {
                            tooltip: {
                                text: 'Cliquez sur la parcelle à supprimer'
                            }
                        }
                    }
                }
            };

            // Enable drawing polygons on ready
            new L.Draw.Polygon(map, drawControl.options.draw.polygon).enable();


            // On draw created, add polygon values to the form
            map.on('draw:created', function (e) {
                var layer = e.layer;
                featureGroup.clearLayers();
                featureGroup.addLayer(layer);
                $("#plot_area").val(getPolygonArea(layer));
                $("#display_area").html(getPolygonArea(layer));
                var latLngs = JSON.stringify(layer.toGeoJSON());
                $("#plot_latLngs").val(latLngs);
                map.fitBounds(layer.getBounds());
            });

            // On draw edited, update polygon values to the form
            map.on('draw:edited', function (e) {
                e.layers.eachLayer(function (layer) {
                    featureGroup.clearLayers();
                    featureGroup.addLayer(layer);
                    $("#plot_area").val(getPolygonArea(layer));
                    $("#display_area").html(getPolygonArea(layer));
                    var latLngs = JSON.stringify(layer.toGeoJSON());
                    $("#plot_latLngs").val(latLngs);
                });
            });

            // On draw deletestop, delete previous plot
            map.on('draw:deletestop', function (e) {
                featureGroup.clearLayers();
                $("#plot_latLngs").val("");
                $("#plot_area").val("");
                $("#display_area").html("0");

            });

            // Get Polygon Area
            function getPolygonArea(layer) {
                var area = LGeo.area(layer) / 10000;
                return area.toFixed(3) ;
            }
        }
        ,
        run: function () {
            this.createMap();
        }
    });

    $(document).ready(function ($) {
        AppPlotNew.run();
    })
}(document, window, jQuery));
