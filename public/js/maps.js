/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@googlemaps/markerclusterer/dist/index.esm.js":
/*!********************************************************************!*\
  !*** ./node_modules/@googlemaps/markerclusterer/dist/index.esm.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AbstractAlgorithm": () => (/* binding */ AbstractAlgorithm),
/* harmony export */   "AbstractViewportAlgorithm": () => (/* binding */ AbstractViewportAlgorithm),
/* harmony export */   "Cluster": () => (/* binding */ Cluster),
/* harmony export */   "ClusterStats": () => (/* binding */ ClusterStats),
/* harmony export */   "DefaultRenderer": () => (/* binding */ DefaultRenderer),
/* harmony export */   "GridAlgorithm": () => (/* binding */ GridAlgorithm),
/* harmony export */   "MarkerClusterer": () => (/* binding */ MarkerClusterer),
/* harmony export */   "MarkerClustererEvents": () => (/* binding */ MarkerClustererEvents),
/* harmony export */   "NoopAlgorithm": () => (/* binding */ NoopAlgorithm),
/* harmony export */   "SuperClusterAlgorithm": () => (/* binding */ SuperClusterAlgorithm),
/* harmony export */   "defaultOnClusterClickHandler": () => (/* binding */ defaultOnClusterClickHandler),
/* harmony export */   "distanceBetweenPoints": () => (/* binding */ distanceBetweenPoints),
/* harmony export */   "extendBoundsToPaddedViewport": () => (/* binding */ extendBoundsToPaddedViewport),
/* harmony export */   "extendPixelBounds": () => (/* binding */ extendPixelBounds),
/* harmony export */   "filterMarkersToPaddedViewport": () => (/* binding */ filterMarkersToPaddedViewport),
/* harmony export */   "noop": () => (/* binding */ noop),
/* harmony export */   "pixelBoundsToLatLngBounds": () => (/* binding */ pixelBoundsToLatLngBounds)
/* harmony export */ });
/* harmony import */ var supercluster__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! supercluster */ "./node_modules/supercluster/index.js");
/* harmony import */ var fast_equals__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! fast-equals */ "./node_modules/fast-equals/dist/fast-equals.js");
/* harmony import */ var fast_equals__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(fast_equals__WEBPACK_IMPORTED_MODULE_1__);



/*! *****************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */

function __rest(s, e) {
    var t = {};
    for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
        t[p] = s[p];
    if (s != null && typeof Object.getOwnPropertySymbols === "function")
        for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
            if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
                t[p[i]] = s[p[i]];
        }
    return t;
}

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
class Cluster {
    constructor({ markers, position }) {
        this.markers = markers;
        if (position) {
            if (position instanceof google.maps.LatLng) {
                this._position = position;
            }
            else {
                this._position = new google.maps.LatLng(position);
            }
        }
    }
    get bounds() {
        if (this.markers.length === 0 && !this._position) {
            return undefined;
        }
        return this.markers.reduce((bounds, marker) => {
            return bounds.extend(marker.getPosition());
        }, new google.maps.LatLngBounds(this._position, this._position));
    }
    get position() {
        return this._position || this.bounds.getCenter();
    }
    /**
     * Get the count of **visible** markers.
     */
    get count() {
        return this.markers.filter((m) => m.getVisible())
            .length;
    }
    /**
     * Add a marker to the cluster.
     */
    push(marker) {
        this.markers.push(marker);
    }
    /**
     * Cleanup references and remove marker from map.
     */
    delete() {
        if (this.marker) {
            this.marker.setMap(null);
            delete this.marker;
        }
        this.markers.length = 0;
    }
}

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
const filterMarkersToPaddedViewport = (map, mapCanvasProjection, markers, viewportPadding) => {
    const extendedMapBounds = extendBoundsToPaddedViewport(map.getBounds(), mapCanvasProjection, viewportPadding);
    return markers.filter((marker) => extendedMapBounds.contains(marker.getPosition()));
};
/**
 * Extends a bounds by a number of pixels in each direction.
 */
const extendBoundsToPaddedViewport = (bounds, projection, pixels) => {
    const { northEast, southWest } = latLngBoundsToPixelBounds(bounds, projection);
    const extendedPixelBounds = extendPixelBounds({ northEast, southWest }, pixels);
    return pixelBoundsToLatLngBounds(extendedPixelBounds, projection);
};
/**
 * @hidden
 */
const distanceBetweenPoints = (p1, p2) => {
    const R = 6371; // Radius of the Earth in km
    const dLat = ((p2.lat - p1.lat) * Math.PI) / 180;
    const dLon = ((p2.lng - p1.lng) * Math.PI) / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos((p1.lat * Math.PI) / 180) *
            Math.cos((p2.lat * Math.PI) / 180) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
};
/**
 * @hidden
 */
const latLngBoundsToPixelBounds = (bounds, projection) => {
    return {
        northEast: projection.fromLatLngToDivPixel(bounds.getNorthEast()),
        southWest: projection.fromLatLngToDivPixel(bounds.getSouthWest()),
    };
};
/**
 * @hidden
 */
const extendPixelBounds = ({ northEast, southWest }, pixels) => {
    northEast.x += pixels;
    northEast.y -= pixels;
    southWest.x -= pixels;
    southWest.y += pixels;
    return { northEast, southWest };
};
/**
 * @hidden
 */
const pixelBoundsToLatLngBounds = ({ northEast, southWest }, projection) => {
    const bounds = new google.maps.LatLngBounds();
    bounds.extend(projection.fromDivPixelToLatLng(northEast));
    bounds.extend(projection.fromDivPixelToLatLng(southWest));
    return bounds;
};

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * @hidden
 */
class AbstractAlgorithm {
    constructor({ maxZoom = 16 }) {
        this.maxZoom = maxZoom;
    }
    /**
     * Helper function to bypass clustering based upon some map state such as
     * zoom, number of markers, etc.
     *
     * ```typescript
     *  cluster({markers, map}: AlgorithmInput): Cluster[] {
     *    if (shouldBypassClustering(map)) {
     *      return this.noop({markers, map})
     *    }
     * }
     * ```
     */
    noop({ markers }) {
        return noop(markers);
    }
}
/**
 * Abstract viewport algorithm proves a class to filter markers by a padded
 * viewport. This is a common optimization.
 *
 * @hidden
 */
class AbstractViewportAlgorithm extends AbstractAlgorithm {
    constructor(_a) {
        var { viewportPadding = 60 } = _a, options = __rest(_a, ["viewportPadding"]);
        super(options);
        this.viewportPadding = 60;
        this.viewportPadding = viewportPadding;
    }
    calculate({ markers, map, mapCanvasProjection, }) {
        if (map.getZoom() >= this.maxZoom) {
            return {
                clusters: this.noop({
                    markers,
                    map,
                    mapCanvasProjection,
                }),
                changed: false,
            };
        }
        return {
            clusters: this.cluster({
                markers: filterMarkersToPaddedViewport(map, mapCanvasProjection, markers, this.viewportPadding),
                map,
                mapCanvasProjection,
            }),
        };
    }
}
/**
 * @hidden
 */
const noop = (markers) => {
    const clusters = markers.map((marker) => new Cluster({
        position: marker.getPosition(),
        markers: [marker],
    }));
    return clusters;
};

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * The default Grid algorithm historically used in Google Maps marker
 * clustering.
 *
 * The Grid algorithm does not implement caching and markers may flash as the
 * viewport changes. Instead use {@link SuperClusterAlgorithm}.
 */
class GridAlgorithm extends AbstractViewportAlgorithm {
    constructor(_a) {
        var { maxDistance = 40000, gridSize = 40 } = _a, options = __rest(_a, ["maxDistance", "gridSize"]);
        super(options);
        this.clusters = [];
        this.maxDistance = maxDistance;
        this.gridSize = gridSize;
    }
    cluster({ markers, map, mapCanvasProjection, }) {
        this.clusters = [];
        markers.forEach((marker) => {
            this.addToClosestCluster(marker, map, mapCanvasProjection);
        });
        return this.clusters;
    }
    addToClosestCluster(marker, map, projection) {
        let maxDistance = this.maxDistance; // Some large number
        let cluster = null;
        for (let i = 0; i < this.clusters.length; i++) {
            const candidate = this.clusters[i];
            const distance = distanceBetweenPoints(candidate.bounds.getCenter().toJSON(), marker.getPosition().toJSON());
            if (distance < maxDistance) {
                maxDistance = distance;
                cluster = candidate;
            }
        }
        if (cluster &&
            extendBoundsToPaddedViewport(cluster.bounds, projection, this.gridSize).contains(marker.getPosition())) {
            cluster.push(marker);
        }
        else {
            const cluster = new Cluster({ markers: [marker] });
            this.clusters.push(cluster);
        }
    }
}

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * Noop algorithm does not generate any clusters or filter markers by the an extended viewport.
 */
class NoopAlgorithm extends AbstractAlgorithm {
    constructor(_a) {
        var options = __rest(_a, []);
        super(options);
    }
    calculate({ markers, map, mapCanvasProjection, }) {
        return {
            clusters: this.cluster({ markers, map, mapCanvasProjection }),
            changed: false,
        };
    }
    cluster(input) {
        return this.noop(input);
    }
}

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * A very fast JavaScript algorithm for geospatial point clustering using KD trees.
 *
 * @see https://www.npmjs.com/package/supercluster for more information on options.
 */
class SuperClusterAlgorithm extends AbstractAlgorithm {
    constructor(_a) {
        var { maxZoom, radius = 60 } = _a, options = __rest(_a, ["maxZoom", "radius"]);
        super({ maxZoom });
        this.superCluster = new supercluster__WEBPACK_IMPORTED_MODULE_0__["default"](Object.assign({ maxZoom: this.maxZoom, radius }, options));
        this.state = { zoom: null };
    }
    calculate(input) {
        let changed = false;
        if (!(0,fast_equals__WEBPACK_IMPORTED_MODULE_1__.deepEqual)(input.markers, this.markers)) {
            changed = true;
            // TODO use proxy to avoid copy?
            this.markers = [...input.markers];
            const points = this.markers.map((marker) => {
                return {
                    type: "Feature",
                    geometry: {
                        type: "Point",
                        coordinates: [
                            marker.getPosition().lng(),
                            marker.getPosition().lat(),
                        ],
                    },
                    properties: { marker },
                };
            });
            this.superCluster.load(points);
        }
        const state = { zoom: input.map.getZoom() };
        if (!changed) {
            if (this.state.zoom > this.maxZoom && state.zoom > this.maxZoom) ;
            else {
                changed = changed || !(0,fast_equals__WEBPACK_IMPORTED_MODULE_1__.deepEqual)(this.state, state);
            }
        }
        this.state = state;
        if (changed) {
            this.clusters = this.cluster(input);
        }
        return { clusters: this.clusters, changed };
    }
    cluster({ map }) {
        return this.superCluster
            .getClusters([-180, -90, 180, 90], Math.round(map.getZoom()))
            .map(this.transformCluster.bind(this));
    }
    transformCluster({ geometry: { coordinates: [lng, lat], }, properties, }) {
        if (properties.cluster) {
            return new Cluster({
                markers: this.superCluster
                    .getLeaves(properties.cluster_id, Infinity)
                    .map((leaf) => leaf.properties.marker),
                position: new google.maps.LatLng({ lat, lng }),
            });
        }
        else {
            const marker = properties.marker;
            return new Cluster({
                markers: [marker],
                position: marker.getPosition(),
            });
        }
    }
}

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * Provides statistics on all clusters in the current render cycle for use in {@link Renderer.render}.
 */
class ClusterStats {
    constructor(markers, clusters) {
        this.markers = { sum: markers.length };
        const clusterMarkerCounts = clusters.map((a) => a.count);
        const clusterMarkerSum = clusterMarkerCounts.reduce((a, b) => a + b, 0);
        this.clusters = {
            count: clusters.length,
            markers: {
                mean: clusterMarkerSum / clusters.length,
                sum: clusterMarkerSum,
                min: Math.min(...clusterMarkerCounts),
                max: Math.max(...clusterMarkerCounts),
            },
        };
    }
}
class DefaultRenderer {
    /**
     * The default render function for the library used by {@link MarkerClusterer}.
     *
     * Currently set to use the following:
     *
     * ```typescript
     * // change color if this cluster has more markers than the mean cluster
     * const color =
     *   count > Math.max(10, stats.clusters.markers.mean)
     *     ? "#ff0000"
     *     : "#0000ff";
     *
     * // create svg url with fill color
     * const svg = window.btoa(`
     * <svg fill="${color}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
     *   <circle cx="120" cy="120" opacity=".6" r="70" />
     *   <circle cx="120" cy="120" opacity=".3" r="90" />
     *   <circle cx="120" cy="120" opacity=".2" r="110" />
     *   <circle cx="120" cy="120" opacity=".1" r="130" />
     * </svg>`);
     *
     * // create marker using svg icon
     * return new google.maps.Marker({
     *   position,
     *   icon: {
     *     url: `data:image/svg+xml;base64,${svg}`,
     *     scaledSize: new google.maps.Size(45, 45),
     *   },
     *   label: {
     *     text: String(count),
     *     color: "rgba(255,255,255,0.9)",
     *     fontSize: "12px",
     *   },
     *   // adjust zIndex to be above other markers
     *   zIndex: 1000 + count,
     * });
     * ```
     */
    render({ count, position }, stats) {
        // change color if this cluster has more markers than the mean cluster
        const color = count > Math.max(10, stats.clusters.markers.mean) ? "#ff0000" : "#0000ff";
        // create svg url with fill color
        const svg = window.btoa(`
  <svg fill="${color}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
    <circle cx="120" cy="120" opacity=".6" r="70" />
    <circle cx="120" cy="120" opacity=".3" r="90" />
    <circle cx="120" cy="120" opacity=".2" r="110" />
  </svg>`);
        // create marker using svg icon
        return new google.maps.Marker({
            position,
            icon: {
                url: `data:image/svg+xml;base64,${svg}`,
                scaledSize: new google.maps.Size(45, 45),
            },
            label: {
                text: String(count),
                color: "rgba(255,255,255,0.9)",
                fontSize: "12px",
            },
            title: `Cluster of ${count} markers`,
            // adjust zIndex to be above other markers
            zIndex: Number(google.maps.Marker.MAX_ZINDEX) + count,
        });
    }
}

/**
 * Copyright 2019 Google LLC. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
/**
 * Extends an object's prototype by another's.
 *
 * @param type1 The Type to be extended.
 * @param type2 The Type to extend with.
 * @ignore
 */
// eslint-disable-next-line @typescript-eslint/no-explicit-any
function extend(type1, type2) {
    /* istanbul ignore next */
    // eslint-disable-next-line prefer-const
    for (let property in type2.prototype) {
        type1.prototype[property] = type2.prototype[property];
    }
}
/**
 * @ignore
 */
class OverlayViewSafe {
    constructor() {
        // MarkerClusterer implements google.maps.OverlayView interface. We use the
        // extend function to extend MarkerClusterer with google.maps.OverlayView
        // because it might not always be available when the code is defined so we
        // look for it at the last possible moment. If it doesn't exist now then
        // there is no point going ahead :)
        extend(OverlayViewSafe, google.maps.OverlayView);
    }
}

/**
 * Copyright 2021 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
var MarkerClustererEvents;
(function (MarkerClustererEvents) {
    MarkerClustererEvents["CLUSTERING_BEGIN"] = "clusteringbegin";
    MarkerClustererEvents["CLUSTERING_END"] = "clusteringend";
    MarkerClustererEvents["CLUSTER_CLICK"] = "click";
})(MarkerClustererEvents || (MarkerClustererEvents = {}));
const defaultOnClusterClickHandler = (_, cluster, map) => {
    map.fitBounds(cluster.bounds);
};
/**
 * MarkerClusterer creates and manages per-zoom-level clusters for large amounts
 * of markers. See {@link MarkerClustererOptions} for more details.
 *
 */
class MarkerClusterer extends OverlayViewSafe {
    constructor({ map, markers = [], algorithm = new SuperClusterAlgorithm({}), renderer = new DefaultRenderer(), onClusterClick = defaultOnClusterClickHandler, }) {
        super();
        this.markers = [...markers];
        this.clusters = [];
        this.algorithm = algorithm;
        this.renderer = renderer;
        this.onClusterClick = onClusterClick;
        if (map) {
            this.setMap(map);
        }
    }
    addMarker(marker, noDraw) {
        if (this.markers.includes(marker)) {
            return;
        }
        this.markers.push(marker);
        if (!noDraw) {
            this.render();
        }
    }
    addMarkers(markers, noDraw) {
        markers.forEach((marker) => {
            this.addMarker(marker, true);
        });
        if (!noDraw) {
            this.render();
        }
    }
    removeMarker(marker, noDraw) {
        const index = this.markers.indexOf(marker);
        if (index === -1) {
            // Marker is not in our list of markers, so do nothing:
            return false;
        }
        marker.setMap(null);
        this.markers.splice(index, 1); // Remove the marker from the list of managed markers
        if (!noDraw) {
            this.render();
        }
        return true;
    }
    removeMarkers(markers, noDraw) {
        let removed = false;
        markers.forEach((marker) => {
            removed = this.removeMarker(marker, true) || removed;
        });
        if (removed && !noDraw) {
            this.render();
        }
        return removed;
    }
    clearMarkers(noDraw) {
        this.markers.length = 0;
        if (!noDraw) {
            this.render();
        }
    }
    /**
     * Recalculates and draws all the marker clusters.
     */
    render() {
        const map = this.getMap();
        if (map instanceof google.maps.Map && this.getProjection()) {
            google.maps.event.trigger(this, MarkerClustererEvents.CLUSTERING_BEGIN, this);
            const { clusters, changed } = this.algorithm.calculate({
                markers: this.markers,
                map,
                mapCanvasProjection: this.getProjection(),
            });
            // allow algorithms to return flag on whether the clusters/markers have changed
            if (changed || changed == undefined) {
                // reset visibility of markers and clusters
                this.reset();
                // store new clusters
                this.clusters = clusters;
                this.renderClusters();
            }
            google.maps.event.trigger(this, MarkerClustererEvents.CLUSTERING_END, this);
        }
    }
    onAdd() {
        this.idleListener = this.getMap().addListener("idle", this.render.bind(this));
        this.render();
    }
    onRemove() {
        google.maps.event.removeListener(this.idleListener);
        this.reset();
    }
    reset() {
        this.markers.forEach((marker) => marker.setMap(null));
        this.clusters.forEach((cluster) => cluster.delete());
        this.clusters = [];
    }
    renderClusters() {
        // generate stats to pass to renderers
        const stats = new ClusterStats(this.markers, this.clusters);
        const map = this.getMap();
        this.clusters.forEach((cluster) => {
            if (cluster.markers.length === 1) {
                cluster.marker = cluster.markers[0];
            }
            else {
                cluster.marker = this.renderer.render(cluster, stats);
                if (this.onClusterClick) {
                    cluster.marker.addListener("click", 
                    /* istanbul ignore next */
                    (event) => {
                        google.maps.event.trigger(this, MarkerClustererEvents.CLUSTER_CLICK, cluster);
                        this.onClusterClick(event, cluster, map);
                    });
                }
            }
            cluster.marker.setMap(map);
        });
    }
}


//# sourceMappingURL=index.esm.js.map


/***/ }),

/***/ "./node_modules/fast-equals/dist/fast-equals.js":
/*!******************************************************!*\
  !*** ./node_modules/fast-equals/dist/fast-equals.js ***!
  \******************************************************/
/***/ (function(__unused_webpack_module, exports) {

(function (global, factory) {
   true ? factory(exports) :
  0;
})(this, (function (exports) { 'use strict';

  var HAS_WEAKSET_SUPPORT = typeof WeakSet === 'function';
  var keys = Object.keys;
  /**
   * are the values passed strictly equal or both NaN
   *
   * @param a the value to compare against
   * @param b the value to test
   * @returns are the values equal by the SameValueZero principle
   */
  function sameValueZeroEqual(a, b) {
      return a === b || (a !== a && b !== b);
  }
  /**
   * is the value a plain object
   *
   * @param value the value to test
   * @returns is the value a plain object
   */
  function isPlainObject(value) {
      return value.constructor === Object || value.constructor == null;
  }
  /**
   * is the value promise-like (meaning it is thenable)
   *
   * @param value the value to test
   * @returns is the value promise-like
   */
  function isPromiseLike(value) {
      return !!value && typeof value.then === 'function';
  }
  /**
   * is the value passed a react element
   *
   * @param value the value to test
   * @returns is the value a react element
   */
  function isReactElement(value) {
      return !!(value && value.$$typeof);
  }
  /**
   * in cases where WeakSet is not supported, creates a new custom
   * object that mimics the necessary API aspects for cache purposes
   *
   * @returns the new cache object
   */
  function getNewCacheFallback() {
      var values = [];
      return {
          add: function (value) {
              values.push(value);
          },
          has: function (value) {
              return values.indexOf(value) !== -1;
          },
      };
  }
  /**
   * get a new cache object to prevent circular references
   *
   * @returns the new cache object
   */
  var getNewCache = (function (canUseWeakMap) {
      if (canUseWeakMap) {
          return function _getNewCache() {
              return new WeakSet();
          };
      }
      return getNewCacheFallback;
  })(HAS_WEAKSET_SUPPORT);
  /**
   * create a custom isEqual handler specific to circular objects
   *
   * @param [isEqual] the isEqual comparator to use instead of isDeepEqual
   * @returns the method to create the `isEqual` function
   */
  function createCircularEqualCreator(isEqual) {
      return function createCircularEqual(comparator) {
          var _comparator = isEqual || comparator;
          return function circularEqual(a, b, indexOrKeyA, indexOrKeyB, parentA, parentB, cache) {
              if (cache === void 0) { cache = getNewCache(); }
              var isCacheableA = !!a && typeof a === 'object';
              var isCacheableB = !!b && typeof b === 'object';
              if (isCacheableA || isCacheableB) {
                  var hasA = isCacheableA && cache.has(a);
                  var hasB = isCacheableB && cache.has(b);
                  if (hasA || hasB) {
                      return hasA && hasB;
                  }
                  if (isCacheableA) {
                      cache.add(a);
                  }
                  if (isCacheableB) {
                      cache.add(b);
                  }
              }
              return _comparator(a, b, cache);
          };
      };
  }
  /**
   * are the arrays equal in value
   *
   * @param a the array to test
   * @param b the array to test against
   * @param isEqual the comparator to determine equality
   * @param meta the meta object to pass through
   * @returns are the arrays equal
   */
  function areArraysEqual(a, b, isEqual, meta) {
      var index = a.length;
      if (b.length !== index) {
          return false;
      }
      while (index-- > 0) {
          if (!isEqual(a[index], b[index], index, index, a, b, meta)) {
              return false;
          }
      }
      return true;
  }
  /**
   * are the maps equal in value
   *
   * @param a the map to test
   * @param b the map to test against
   * @param isEqual the comparator to determine equality
   * @param meta the meta map to pass through
   * @returns are the maps equal
   */
  function areMapsEqual(a, b, isEqual, meta) {
      var isValueEqual = a.size === b.size;
      if (isValueEqual && a.size) {
          var matchedIndices_1 = {};
          var indexA_1 = 0;
          a.forEach(function (aValue, aKey) {
              if (isValueEqual) {
                  var hasMatch_1 = false;
                  var matchIndexB_1 = 0;
                  b.forEach(function (bValue, bKey) {
                      if (!hasMatch_1 && !matchedIndices_1[matchIndexB_1]) {
                          hasMatch_1 =
                              isEqual(aKey, bKey, indexA_1, matchIndexB_1, a, b, meta) && isEqual(aValue, bValue, aKey, bKey, a, b, meta);
                          if (hasMatch_1) {
                              matchedIndices_1[matchIndexB_1] = true;
                          }
                      }
                      matchIndexB_1++;
                  });
                  indexA_1++;
                  isValueEqual = hasMatch_1;
              }
          });
      }
      return isValueEqual;
  }
  var OWNER = '_owner';
  var hasOwnProperty = Function.prototype.bind.call(Function.prototype.call, Object.prototype.hasOwnProperty);
  /**
   * are the objects equal in value
   *
   * @param a the object to test
   * @param b the object to test against
   * @param isEqual the comparator to determine equality
   * @param meta the meta object to pass through
   * @returns are the objects equal
   */
  function areObjectsEqual(a, b, isEqual, meta) {
      var keysA = keys(a);
      var index = keysA.length;
      if (keys(b).length !== index) {
          return false;
      }
      if (index) {
          var key = void 0;
          while (index-- > 0) {
              key = keysA[index];
              if (key === OWNER) {
                  var reactElementA = isReactElement(a);
                  var reactElementB = isReactElement(b);
                  if ((reactElementA || reactElementB) &&
                      reactElementA !== reactElementB) {
                      return false;
                  }
              }
              if (!hasOwnProperty(b, key) || !isEqual(a[key], b[key], key, key, a, b, meta)) {
                  return false;
              }
          }
      }
      return true;
  }
  /**
   * are the regExps equal in value
   *
   * @param a the regExp to test
   * @param b the regExp to test agains
   * @returns are the regExps equal
   */
  function areRegExpsEqual(a, b) {
      return (a.source === b.source &&
          a.global === b.global &&
          a.ignoreCase === b.ignoreCase &&
          a.multiline === b.multiline &&
          a.unicode === b.unicode &&
          a.sticky === b.sticky &&
          a.lastIndex === b.lastIndex);
  }
  /**
   * are the sets equal in value
   *
   * @param a the set to test
   * @param b the set to test against
   * @param isEqual the comparator to determine equality
   * @param meta the meta set to pass through
   * @returns are the sets equal
   */
  function areSetsEqual(a, b, isEqual, meta) {
      var isValueEqual = a.size === b.size;
      if (isValueEqual && a.size) {
          var matchedIndices_2 = {};
          a.forEach(function (aValue, aKey) {
              if (isValueEqual) {
                  var hasMatch_2 = false;
                  var matchIndex_1 = 0;
                  b.forEach(function (bValue, bKey) {
                      if (!hasMatch_2 && !matchedIndices_2[matchIndex_1]) {
                          hasMatch_2 = isEqual(aValue, bValue, aKey, bKey, a, b, meta);
                          if (hasMatch_2) {
                              matchedIndices_2[matchIndex_1] = true;
                          }
                      }
                      matchIndex_1++;
                  });
                  isValueEqual = hasMatch_2;
              }
          });
      }
      return isValueEqual;
  }

  var HAS_MAP_SUPPORT = typeof Map === 'function';
  var HAS_SET_SUPPORT = typeof Set === 'function';
  function createComparator(createIsEqual) {
      var isEqual = 
      /* eslint-disable no-use-before-define */
      typeof createIsEqual === 'function'
          ? createIsEqual(comparator)
          : function (a, b, indexOrKeyA, indexOrKeyB, parentA, parentB, meta) { return comparator(a, b, meta); };
      /* eslint-enable */
      /**
       * compare the value of the two objects and return true if they are equivalent in values
       *
       * @param a the value to test against
       * @param b the value to test
       * @param [meta] an optional meta object that is passed through to all equality test calls
       * @returns are a and b equivalent in value
       */
      function comparator(a, b, meta) {
          if (a === b) {
              return true;
          }
          if (a && b && typeof a === 'object' && typeof b === 'object') {
              if (isPlainObject(a) && isPlainObject(b)) {
                  return areObjectsEqual(a, b, isEqual, meta);
              }
              var aShape = Array.isArray(a);
              var bShape = Array.isArray(b);
              if (aShape || bShape) {
                  return aShape === bShape && areArraysEqual(a, b, isEqual, meta);
              }
              aShape = a instanceof Date;
              bShape = b instanceof Date;
              if (aShape || bShape) {
                  return (aShape === bShape && sameValueZeroEqual(a.getTime(), b.getTime()));
              }
              aShape = a instanceof RegExp;
              bShape = b instanceof RegExp;
              if (aShape || bShape) {
                  return aShape === bShape && areRegExpsEqual(a, b);
              }
              if (isPromiseLike(a) || isPromiseLike(b)) {
                  return a === b;
              }
              if (HAS_MAP_SUPPORT) {
                  aShape = a instanceof Map;
                  bShape = b instanceof Map;
                  if (aShape || bShape) {
                      return aShape === bShape && areMapsEqual(a, b, isEqual, meta);
                  }
              }
              if (HAS_SET_SUPPORT) {
                  aShape = a instanceof Set;
                  bShape = b instanceof Set;
                  if (aShape || bShape) {
                      return aShape === bShape && areSetsEqual(a, b, isEqual, meta);
                  }
              }
              return areObjectsEqual(a, b, isEqual, meta);
          }
          return a !== a && b !== b;
      }
      return comparator;
  }

  var deepEqual = createComparator();
  var shallowEqual = createComparator(function () { return sameValueZeroEqual; });
  var circularDeepEqual = createComparator(createCircularEqualCreator());
  var circularShallowEqual = createComparator(createCircularEqualCreator(sameValueZeroEqual));

  exports.circularDeepEqual = circularDeepEqual;
  exports.circularShallowEqual = circularShallowEqual;
  exports.createCustomEqual = createComparator;
  exports.deepEqual = deepEqual;
  exports.sameValueZeroEqual = sameValueZeroEqual;
  exports.shallowEqual = shallowEqual;

  Object.defineProperty(exports, '__esModule', { value: true });

}));
//# sourceMappingURL=fast-equals.js.map


/***/ }),

/***/ "./node_modules/kdbush/src/index.js":
/*!******************************************!*\
  !*** ./node_modules/kdbush/src/index.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ KDBush)
/* harmony export */ });
/* harmony import */ var _sort__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sort */ "./node_modules/kdbush/src/sort.js");
/* harmony import */ var _range__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./range */ "./node_modules/kdbush/src/range.js");
/* harmony import */ var _within__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./within */ "./node_modules/kdbush/src/within.js");





const defaultGetX = p => p[0];
const defaultGetY = p => p[1];

class KDBush {
    constructor(points, getX = defaultGetX, getY = defaultGetY, nodeSize = 64, ArrayType = Float64Array) {
        this.nodeSize = nodeSize;
        this.points = points;

        const IndexArrayType = points.length < 65536 ? Uint16Array : Uint32Array;

        const ids = this.ids = new IndexArrayType(points.length);
        const coords = this.coords = new ArrayType(points.length * 2);

        for (let i = 0; i < points.length; i++) {
            ids[i] = i;
            coords[2 * i] = getX(points[i]);
            coords[2 * i + 1] = getY(points[i]);
        }

        (0,_sort__WEBPACK_IMPORTED_MODULE_0__["default"])(ids, coords, nodeSize, 0, ids.length - 1, 0);
    }

    range(minX, minY, maxX, maxY) {
        return (0,_range__WEBPACK_IMPORTED_MODULE_1__["default"])(this.ids, this.coords, minX, minY, maxX, maxY, this.nodeSize);
    }

    within(x, y, r) {
        return (0,_within__WEBPACK_IMPORTED_MODULE_2__["default"])(this.ids, this.coords, x, y, r, this.nodeSize);
    }
}


/***/ }),

/***/ "./node_modules/kdbush/src/range.js":
/*!******************************************!*\
  !*** ./node_modules/kdbush/src/range.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ range)
/* harmony export */ });

function range(ids, coords, minX, minY, maxX, maxY, nodeSize) {
    const stack = [0, ids.length - 1, 0];
    const result = [];
    let x, y;

    while (stack.length) {
        const axis = stack.pop();
        const right = stack.pop();
        const left = stack.pop();

        if (right - left <= nodeSize) {
            for (let i = left; i <= right; i++) {
                x = coords[2 * i];
                y = coords[2 * i + 1];
                if (x >= minX && x <= maxX && y >= minY && y <= maxY) result.push(ids[i]);
            }
            continue;
        }

        const m = Math.floor((left + right) / 2);

        x = coords[2 * m];
        y = coords[2 * m + 1];

        if (x >= minX && x <= maxX && y >= minY && y <= maxY) result.push(ids[m]);

        const nextAxis = (axis + 1) % 2;

        if (axis === 0 ? minX <= x : minY <= y) {
            stack.push(left);
            stack.push(m - 1);
            stack.push(nextAxis);
        }
        if (axis === 0 ? maxX >= x : maxY >= y) {
            stack.push(m + 1);
            stack.push(right);
            stack.push(nextAxis);
        }
    }

    return result;
}


/***/ }),

/***/ "./node_modules/kdbush/src/sort.js":
/*!*****************************************!*\
  !*** ./node_modules/kdbush/src/sort.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ sortKD)
/* harmony export */ });

function sortKD(ids, coords, nodeSize, left, right, depth) {
    if (right - left <= nodeSize) return;

    const m = (left + right) >> 1;

    select(ids, coords, m, left, right, depth % 2);

    sortKD(ids, coords, nodeSize, left, m - 1, depth + 1);
    sortKD(ids, coords, nodeSize, m + 1, right, depth + 1);
}

function select(ids, coords, k, left, right, inc) {

    while (right > left) {
        if (right - left > 600) {
            const n = right - left + 1;
            const m = k - left + 1;
            const z = Math.log(n);
            const s = 0.5 * Math.exp(2 * z / 3);
            const sd = 0.5 * Math.sqrt(z * s * (n - s) / n) * (m - n / 2 < 0 ? -1 : 1);
            const newLeft = Math.max(left, Math.floor(k - m * s / n + sd));
            const newRight = Math.min(right, Math.floor(k + (n - m) * s / n + sd));
            select(ids, coords, k, newLeft, newRight, inc);
        }

        const t = coords[2 * k + inc];
        let i = left;
        let j = right;

        swapItem(ids, coords, left, k);
        if (coords[2 * right + inc] > t) swapItem(ids, coords, left, right);

        while (i < j) {
            swapItem(ids, coords, i, j);
            i++;
            j--;
            while (coords[2 * i + inc] < t) i++;
            while (coords[2 * j + inc] > t) j--;
        }

        if (coords[2 * left + inc] === t) swapItem(ids, coords, left, j);
        else {
            j++;
            swapItem(ids, coords, j, right);
        }

        if (j <= k) left = j + 1;
        if (k <= j) right = j - 1;
    }
}

function swapItem(ids, coords, i, j) {
    swap(ids, i, j);
    swap(coords, 2 * i, 2 * j);
    swap(coords, 2 * i + 1, 2 * j + 1);
}

function swap(arr, i, j) {
    const tmp = arr[i];
    arr[i] = arr[j];
    arr[j] = tmp;
}


/***/ }),

/***/ "./node_modules/kdbush/src/within.js":
/*!*******************************************!*\
  !*** ./node_modules/kdbush/src/within.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ within)
/* harmony export */ });

function within(ids, coords, qx, qy, r, nodeSize) {
    const stack = [0, ids.length - 1, 0];
    const result = [];
    const r2 = r * r;

    while (stack.length) {
        const axis = stack.pop();
        const right = stack.pop();
        const left = stack.pop();

        if (right - left <= nodeSize) {
            for (let i = left; i <= right; i++) {
                if (sqDist(coords[2 * i], coords[2 * i + 1], qx, qy) <= r2) result.push(ids[i]);
            }
            continue;
        }

        const m = Math.floor((left + right) / 2);

        const x = coords[2 * m];
        const y = coords[2 * m + 1];

        if (sqDist(x, y, qx, qy) <= r2) result.push(ids[m]);

        const nextAxis = (axis + 1) % 2;

        if (axis === 0 ? qx - r <= x : qy - r <= y) {
            stack.push(left);
            stack.push(m - 1);
            stack.push(nextAxis);
        }
        if (axis === 0 ? qx + r >= x : qy + r >= y) {
            stack.push(m + 1);
            stack.push(right);
            stack.push(nextAxis);
        }
    }

    return result;
}

function sqDist(ax, ay, bx, by) {
    const dx = ax - bx;
    const dy = ay - by;
    return dx * dx + dy * dy;
}


/***/ }),

/***/ "./node_modules/supercluster/index.js":
/*!********************************************!*\
  !*** ./node_modules/supercluster/index.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Supercluster)
/* harmony export */ });
/* harmony import */ var kdbush__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! kdbush */ "./node_modules/kdbush/src/index.js");



const defaultOptions = {
    minZoom: 0,   // min zoom to generate clusters on
    maxZoom: 16,  // max zoom level to cluster the points on
    minPoints: 2, // minimum points to form a cluster
    radius: 40,   // cluster radius in pixels
    extent: 512,  // tile extent (radius is calculated relative to it)
    nodeSize: 64, // size of the KD-tree leaf node, affects performance
    log: false,   // whether to log timing info

    // whether to generate numeric ids for input features (in vector tiles)
    generateId: false,

    // a reduce function for calculating custom cluster properties
    reduce: null, // (accumulated, props) => { accumulated.sum += props.sum; }

    // properties to use for individual points when running the reducer
    map: props => props // props => ({sum: props.my_value})
};

const fround = Math.fround || (tmp => ((x) => { tmp[0] = +x; return tmp[0]; }))(new Float32Array(1));

class Supercluster {
    constructor(options) {
        this.options = extend(Object.create(defaultOptions), options);
        this.trees = new Array(this.options.maxZoom + 1);
    }

    load(points) {
        const {log, minZoom, maxZoom, nodeSize} = this.options;

        if (log) console.time('total time');

        const timerId = `prepare ${  points.length  } points`;
        if (log) console.time(timerId);

        this.points = points;

        // generate a cluster object for each point and index input points into a KD-tree
        let clusters = [];
        for (let i = 0; i < points.length; i++) {
            if (!points[i].geometry) continue;
            clusters.push(createPointCluster(points[i], i));
        }
        this.trees[maxZoom + 1] = new kdbush__WEBPACK_IMPORTED_MODULE_0__["default"](clusters, getX, getY, nodeSize, Float32Array);

        if (log) console.timeEnd(timerId);

        // cluster points on max zoom, then cluster the results on previous zoom, etc.;
        // results in a cluster hierarchy across zoom levels
        for (let z = maxZoom; z >= minZoom; z--) {
            const now = +Date.now();

            // create a new set of clusters for the zoom and index them with a KD-tree
            clusters = this._cluster(clusters, z);
            this.trees[z] = new kdbush__WEBPACK_IMPORTED_MODULE_0__["default"](clusters, getX, getY, nodeSize, Float32Array);

            if (log) console.log('z%d: %d clusters in %dms', z, clusters.length, +Date.now() - now);
        }

        if (log) console.timeEnd('total time');

        return this;
    }

    getClusters(bbox, zoom) {
        let minLng = ((bbox[0] + 180) % 360 + 360) % 360 - 180;
        const minLat = Math.max(-90, Math.min(90, bbox[1]));
        let maxLng = bbox[2] === 180 ? 180 : ((bbox[2] + 180) % 360 + 360) % 360 - 180;
        const maxLat = Math.max(-90, Math.min(90, bbox[3]));

        if (bbox[2] - bbox[0] >= 360) {
            minLng = -180;
            maxLng = 180;
        } else if (minLng > maxLng) {
            const easternHem = this.getClusters([minLng, minLat, 180, maxLat], zoom);
            const westernHem = this.getClusters([-180, minLat, maxLng, maxLat], zoom);
            return easternHem.concat(westernHem);
        }

        const tree = this.trees[this._limitZoom(zoom)];
        const ids = tree.range(lngX(minLng), latY(maxLat), lngX(maxLng), latY(minLat));
        const clusters = [];
        for (const id of ids) {
            const c = tree.points[id];
            clusters.push(c.numPoints ? getClusterJSON(c) : this.points[c.index]);
        }
        return clusters;
    }

    getChildren(clusterId) {
        const originId = this._getOriginId(clusterId);
        const originZoom = this._getOriginZoom(clusterId);
        const errorMsg = 'No cluster with the specified id.';

        const index = this.trees[originZoom];
        if (!index) throw new Error(errorMsg);

        const origin = index.points[originId];
        if (!origin) throw new Error(errorMsg);

        const r = this.options.radius / (this.options.extent * Math.pow(2, originZoom - 1));
        const ids = index.within(origin.x, origin.y, r);
        const children = [];
        for (const id of ids) {
            const c = index.points[id];
            if (c.parentId === clusterId) {
                children.push(c.numPoints ? getClusterJSON(c) : this.points[c.index]);
            }
        }

        if (children.length === 0) throw new Error(errorMsg);

        return children;
    }

    getLeaves(clusterId, limit, offset) {
        limit = limit || 10;
        offset = offset || 0;

        const leaves = [];
        this._appendLeaves(leaves, clusterId, limit, offset, 0);

        return leaves;
    }

    getTile(z, x, y) {
        const tree = this.trees[this._limitZoom(z)];
        const z2 = Math.pow(2, z);
        const {extent, radius} = this.options;
        const p = radius / extent;
        const top = (y - p) / z2;
        const bottom = (y + 1 + p) / z2;

        const tile = {
            features: []
        };

        this._addTileFeatures(
            tree.range((x - p) / z2, top, (x + 1 + p) / z2, bottom),
            tree.points, x, y, z2, tile);

        if (x === 0) {
            this._addTileFeatures(
                tree.range(1 - p / z2, top, 1, bottom),
                tree.points, z2, y, z2, tile);
        }
        if (x === z2 - 1) {
            this._addTileFeatures(
                tree.range(0, top, p / z2, bottom),
                tree.points, -1, y, z2, tile);
        }

        return tile.features.length ? tile : null;
    }

    getClusterExpansionZoom(clusterId) {
        let expansionZoom = this._getOriginZoom(clusterId) - 1;
        while (expansionZoom <= this.options.maxZoom) {
            const children = this.getChildren(clusterId);
            expansionZoom++;
            if (children.length !== 1) break;
            clusterId = children[0].properties.cluster_id;
        }
        return expansionZoom;
    }

    _appendLeaves(result, clusterId, limit, offset, skipped) {
        const children = this.getChildren(clusterId);

        for (const child of children) {
            const props = child.properties;

            if (props && props.cluster) {
                if (skipped + props.point_count <= offset) {
                    // skip the whole cluster
                    skipped += props.point_count;
                } else {
                    // enter the cluster
                    skipped = this._appendLeaves(result, props.cluster_id, limit, offset, skipped);
                    // exit the cluster
                }
            } else if (skipped < offset) {
                // skip a single point
                skipped++;
            } else {
                // add a single point
                result.push(child);
            }
            if (result.length === limit) break;
        }

        return skipped;
    }

    _addTileFeatures(ids, points, x, y, z2, tile) {
        for (const i of ids) {
            const c = points[i];
            const isCluster = c.numPoints;

            let tags, px, py;
            if (isCluster) {
                tags = getClusterProperties(c);
                px = c.x;
                py = c.y;
            } else {
                const p = this.points[c.index];
                tags = p.properties;
                px = lngX(p.geometry.coordinates[0]);
                py = latY(p.geometry.coordinates[1]);
            }

            const f = {
                type: 1,
                geometry: [[
                    Math.round(this.options.extent * (px * z2 - x)),
                    Math.round(this.options.extent * (py * z2 - y))
                ]],
                tags
            };

            // assign id
            let id;
            if (isCluster) {
                id = c.id;
            } else if (this.options.generateId) {
                // optionally generate id
                id = c.index;
            } else if (this.points[c.index].id) {
                // keep id if already assigned
                id = this.points[c.index].id;
            }

            if (id !== undefined) f.id = id;

            tile.features.push(f);
        }
    }

    _limitZoom(z) {
        return Math.max(this.options.minZoom, Math.min(+z, this.options.maxZoom + 1));
    }

    _cluster(points, zoom) {
        const clusters = [];
        const {radius, extent, reduce, minPoints} = this.options;
        const r = radius / (extent * Math.pow(2, zoom));

        // loop through each point
        for (let i = 0; i < points.length; i++) {
            const p = points[i];
            // if we've already visited the point at this zoom level, skip it
            if (p.zoom <= zoom) continue;
            p.zoom = zoom;

            // find all nearby points
            const tree = this.trees[zoom + 1];
            const neighborIds = tree.within(p.x, p.y, r);

            const numPointsOrigin = p.numPoints || 1;
            let numPoints = numPointsOrigin;

            // count the number of points in a potential cluster
            for (const neighborId of neighborIds) {
                const b = tree.points[neighborId];
                // filter out neighbors that are already processed
                if (b.zoom > zoom) numPoints += b.numPoints || 1;
            }

            // if there were neighbors to merge, and there are enough points to form a cluster
            if (numPoints > numPointsOrigin && numPoints >= minPoints) {
                let wx = p.x * numPointsOrigin;
                let wy = p.y * numPointsOrigin;

                let clusterProperties = reduce && numPointsOrigin > 1 ? this._map(p, true) : null;

                // encode both zoom and point index on which the cluster originated -- offset by total length of features
                const id = (i << 5) + (zoom + 1) + this.points.length;

                for (const neighborId of neighborIds) {
                    const b = tree.points[neighborId];

                    if (b.zoom <= zoom) continue;
                    b.zoom = zoom; // save the zoom (so it doesn't get processed twice)

                    const numPoints2 = b.numPoints || 1;
                    wx += b.x * numPoints2; // accumulate coordinates for calculating weighted center
                    wy += b.y * numPoints2;

                    b.parentId = id;

                    if (reduce) {
                        if (!clusterProperties) clusterProperties = this._map(p, true);
                        reduce(clusterProperties, this._map(b));
                    }
                }

                p.parentId = id;
                clusters.push(createCluster(wx / numPoints, wy / numPoints, id, numPoints, clusterProperties));

            } else { // left points as unclustered
                clusters.push(p);

                if (numPoints > 1) {
                    for (const neighborId of neighborIds) {
                        const b = tree.points[neighborId];
                        if (b.zoom <= zoom) continue;
                        b.zoom = zoom;
                        clusters.push(b);
                    }
                }
            }
        }

        return clusters;
    }

    // get index of the point from which the cluster originated
    _getOriginId(clusterId) {
        return (clusterId - this.points.length) >> 5;
    }

    // get zoom of the point from which the cluster originated
    _getOriginZoom(clusterId) {
        return (clusterId - this.points.length) % 32;
    }

    _map(point, clone) {
        if (point.numPoints) {
            return clone ? extend({}, point.properties) : point.properties;
        }
        const original = this.points[point.index].properties;
        const result = this.options.map(original);
        return clone && result === original ? extend({}, result) : result;
    }
}

function createCluster(x, y, id, numPoints, properties) {
    return {
        x: fround(x), // weighted cluster center; round for consistency with Float32Array index
        y: fround(y),
        zoom: Infinity, // the last zoom the cluster was processed at
        id, // encodes index of the first child of the cluster and its zoom level
        parentId: -1, // parent cluster id
        numPoints,
        properties
    };
}

function createPointCluster(p, id) {
    const [x, y] = p.geometry.coordinates;
    return {
        x: fround(lngX(x)), // projected point coordinates
        y: fround(latY(y)),
        zoom: Infinity, // the last zoom the point was processed at
        index: id, // index of the source feature in the original input array,
        parentId: -1 // parent cluster id
    };
}

function getClusterJSON(cluster) {
    return {
        type: 'Feature',
        id: cluster.id,
        properties: getClusterProperties(cluster),
        geometry: {
            type: 'Point',
            coordinates: [xLng(cluster.x), yLat(cluster.y)]
        }
    };
}

function getClusterProperties(cluster) {
    const count = cluster.numPoints;
    const abbrev =
        count >= 10000 ? `${Math.round(count / 1000)  }k` :
        count >= 1000 ? `${Math.round(count / 100) / 10  }k` : count;
    return extend(extend({}, cluster.properties), {
        cluster: true,
        cluster_id: cluster.id,
        point_count: count,
        point_count_abbreviated: abbrev
    });
}

// longitude/latitude to spherical mercator in [0..1] range
function lngX(lng) {
    return lng / 360 + 0.5;
}
function latY(lat) {
    const sin = Math.sin(lat * Math.PI / 180);
    const y = (0.5 - 0.25 * Math.log((1 + sin) / (1 - sin)) / Math.PI);
    return y < 0 ? 0 : y > 1 ? 1 : y;
}

// spherical mercator to longitude/latitude
function xLng(x) {
    return (x - 0.5) * 360;
}
function yLat(y) {
    const y2 = (180 - y * 360) * Math.PI / 180;
    return 360 * Math.atan(Math.exp(y2)) / Math.PI - 90;
}

function extend(dest, src) {
    for (const id in src) dest[id] = src[id];
    return dest;
}

function getX(p) {
    return p.x;
}
function getY(p) {
    return p.y;
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!******************************!*\
  !*** ./resources/js/maps.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _googlemaps_markerclusterer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @googlemaps/markerclusterer */ "./node_modules/@googlemaps/markerclusterer/dist/index.esm.js");


window.onload = function initMap() {
  var center_map = center;
  var escorts_data = geodata;
  var locations = [];
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 13,
    disableDefaultUI: true,
    center: center_map,
    panControl: false,
    zoomControl: true,
    scaleControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    MapTypeControl: false,
    fullScreenControl: false,
    streetViewControl: false,
    OverviewMapControl: false,
    mapTypeControlOptions: false
  });
  var markers = [];
  escorts_data.forEach(function (user) {
    markers.push(createMarker(user, map));
  });
  var markerCluster = new _googlemaps_markerclusterer__WEBPACK_IMPORTED_MODULE_0__.MarkerClusterer({
    markers: markers,
    map: map
  }); // markerCluster.renderer.render()
};

var prev_infowindow = false;

function createMarker(user, map) {
  var template = "<div class=\"d-flex flex-column map-panel\">\n        <a href=\"".concat(user.link, "\"><img src=\"").concat(user.image, "\" style=\"height:150px;\" class=\"mx-auto\"/></a>\n    <p class=\"px-2 lineh08\"><span class=\"firstHeading\"><a href=\"").concat(user.link, "\">").concat(user.name, "</a></span><br />\n    <span class=\"price\">").concat(user.price, " \u20AC</span></p>\n    </div>");
  var svg = window.btoa("<svg width=\"382\" height=\"382\" viewBox=\"0 0 382 382\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n    <rect width=\"382\" height=\"381\" rx=\"190.5\" fill=\"white\"/>\n    <path d=\"M173.244 0.912922C86.9443 8.61292 15.6443 75.6129 2.24433 161.813C-5.05567 208.313 5.64433 257.513 31.5443 296.513L36.9443 304.613L44.5443 298.213C55.8443 288.613 78.3443 273.813 93.6443 265.913C123.344 250.613 165.444 233.113 206.144 219.213L233.144 210.013V205.113C233.044 198.913 230.244 194.813 222.644 189.913C216.144 185.713 214.444 185.013 181.644 174.413C151.944 164.713 137.944 158.113 129.244 149.413C125.844 146.113 121.944 141.213 120.744 138.513C109.444 114.913 131.344 81.5129 177.044 52.8129C196.144 40.8129 218.744 30.5129 236.644 25.6129C243.444 23.8129 247.644 23.4129 257.644 23.4129C276.744 23.4129 288.144 27.5129 299.444 38.2129C309.544 47.7129 312.244 55.6129 309.144 66.4129C305.544 79.2129 294.144 93.8129 278.144 106.313C265.744 116.013 261.044 118.413 246.644 122.813C232.544 127.013 228.644 127.613 228.644 125.513C228.644 124.813 236.344 116.613 245.744 107.313C272.444 80.7129 282.644 66.4129 282.644 55.2129C282.644 51.8129 282.044 49.3129 280.944 47.9129C273.544 38.8129 242.544 47.5129 207.544 68.4129C176.444 87.0129 154.444 107.313 148.544 122.813C141.244 141.913 152.744 150.813 204.144 165.813C223.144 171.313 234.644 177.213 243.844 185.813C247.844 189.513 252.544 194.913 254.144 197.713C255.844 200.513 257.644 202.813 258.144 202.813C258.744 202.813 265.644 201.513 273.644 199.813C281.644 198.213 295.044 196.113 303.344 195.213C318.244 193.513 318.644 193.513 327.844 195.613C332.944 196.813 340.844 198.213 345.344 198.913C349.844 199.513 354.044 200.613 354.644 201.313C356.744 203.813 351.644 205.513 333.744 208.813C313.744 212.313 261.644 225.313 260.044 227.113C259.444 227.813 258.144 230.313 257.244 232.613C251.844 246.713 231.344 268.913 206.344 287.713C176.044 310.413 125.944 340.313 100.244 350.913L91.4443 354.613L99.7443 359.113C110.544 365.013 128.244 372.113 139.944 375.213C159.944 380.613 165.644 381.313 191.144 381.313C212.544 381.313 216.444 381.013 226.644 378.913C255.544 373.013 282.544 361.113 305.544 344.113C314.544 337.413 331.644 321.013 339.144 311.813C359.344 287.013 373.044 256.913 379.344 223.313C381.444 212.113 382.244 181.313 380.744 169.113C375.344 125.913 355.944 85.9129 325.644 55.8129C293.344 23.6129 252.344 4.81292 205.644 0.812922C192.644 -0.287078 187.344 -0.287078 173.244 0.912922Z\" fill=\"#FF0000\"/>\n    <path d=\"M187.144 251.713C142.444 269.613 108.144 286.413 85.6443 301.313C75.2443 308.213 59.3443 321.613 57.5443 325.013C56.4443 327.013 56.8443 327.613 60.5443 331.013L64.7443 334.713L71.9443 332.113C88.5443 326.113 108.644 316.313 125.644 305.813C140.144 296.813 168.544 277.513 181.144 268.013C191.544 260.213 211.044 243.013 209.644 242.913C209.344 242.813 199.244 246.813 187.144 251.713Z\" fill=\"#FF0000\"/>\n    </svg>\n    ");
  var marker = new google.maps.Marker({
    position: {
      lat: user.lat,
      lng: user.lng
    },
    map: map,
    icon: {
      url: "data:image/svg+xml;base64,".concat(svg),
      scaledSize: new google.maps.Size(45, 45)
    } // label: {
    //     text: 'Escorts Secret',
    //     color: "rgba(255,255,255,0.9)",
    //     fontSize: "12px",
    // },

  });
  var infoWindow = new google.maps.InfoWindow({
    content: template
  });
  marker.addListener("click", function () {
    infoWindow.open({
      anchor: marker,
      map: map,
      shouldFocus: false
    });

    if (prev_infowindow) {
      prev_infowindow.close();
    }

    prev_infowindow = infoWindow;
  });
  return marker;
}
})();

/******/ })()
;