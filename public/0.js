(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FilteredListingContainer.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/FilteredListingContainer.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var velocity_animate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! velocity-animate */ "./node_modules/velocity-animate/velocity.js");
/* harmony import */ var velocity_animate__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(velocity_animate__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['data'],
  methods: {
    reviewScoreMessage: function reviewScoreMessage(score) {
      if (score > 2) return 'homepage.card.review.positive';
      if (score === 2) return 'homepage.card.review.mediocre';
      if (score > 0) return 'homepage.card.review.negative';
      return 'homepage.card.review.fresh';
    },
    visit: function visit(slug) {
      window.location.href = '/listing/' + slug;
    },
    beforeEnter: function beforeEnter(el) {
      el.style.opacity = 0;
      el.style.height = 0;
    },
    enter: function enter(el, done) {
      var delay = el.dataset.index * 0.4;
      setTimeout(function () {
        velocity_animate__WEBPACK_IMPORTED_MODULE_0___default()(el, {
          opacity: 1,
          height: '270px'
        }, {
          complete: done
        });
      }, delay);
    },
    leave: function leave(el, done) {
      var delay = el.dataset.index * 0.4;
      setTimeout(function () {
        velocity_animate__WEBPACK_IMPORTED_MODULE_0___default()(el, {
          opacity: 0,
          height: 0
        }, {
          complete: done
        });
      }, delay);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FilteredListingContainer.vue?vue&type=template&id=5520fbff&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/FilteredListingContainer.vue?vue&type=template&id=5520fbff& ***!
  \***************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "transition-group",
    {
      attrs: { name: "staggered-fade", css: false },
      on: {
        "before-enter": _vm.beforeEnter,
        enter: _vm.enter,
        leave: _vm.leave
      }
    },
    _vm._l(_vm.data, function(listing) {
      return _c(
        "div",
        { key: listing["id"], attrs: { "data-index": listing["id"] } },
        [
          _c(
            "div",
            {
              staticClass:
                "mb-3 server-card item flex-fill tw-shadow border rounded"
            },
            [
              _c("div", {
                staticClass: "server-card-head image rounded-top",
                style: {
                  "background-image": "url(" + listing["background"] + ")"
                }
              }),
              _vm._v(" "),
              _c("div", { staticClass: "server-card-head overlap d-flex" }, [
                _c(
                  "div",
                  {
                    staticClass:
                      "left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end"
                  },
                  [
                    _c(
                      "h1",
                      {
                        staticClass: "font-weight-bold mb-0",
                        staticStyle: {
                          "font-size": "26px",
                          color: "rgb(243, 243, 243)"
                        }
                      },
                      [_vm._v(_vm._s(listing["name"]))]
                    ),
                    _vm._v(" "),
                    _c(
                      "ul",
                      {
                        staticClass:
                          "tag-list tw-list-reset tw-flex tw-text-xs tw-text-green-light",
                        staticStyle: {
                          "font-size": "13px",
                          "margin-bottom": ".5rem"
                        }
                      },
                      _vm._l(listing.tags, function(tag) {
                        return _c("li", { staticClass: "mr-2" }, [
                          _vm._v("#" + _vm._s(tag))
                        ])
                      }),
                      0
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass:
                      "right-side flex-fill d-flex justify-content-end pr-3",
                    staticStyle: { "padding-bottom": "12px" }
                  },
                  [
                    _c(
                      "div",
                      {
                        staticClass:
                          "d-flex flex-column justify-content-end mr-3",
                        staticStyle: { height: "100%" }
                      },
                      [
                        _c(
                          "h3",
                          {
                            staticClass:
                              "card-counter-title mb-0 font-weight-bold transparency"
                          },
                          [_vm._v("Votes")]
                        ),
                        _vm._v(" "),
                        _c(
                          "span",
                          {
                            staticClass:
                              "card-counter font-weight-bold transparency"
                          },
                          [_vm._v(_vm._s(listing["ranking"]["votes"]))]
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "d-flex flex-column justify-content-end mr-2",
                        staticStyle: { height: "100%" }
                      },
                      [
                        _c(
                          "h3",
                          {
                            staticClass:
                              "card-counter-title mb-0 font-weight-bold transparency"
                          },
                          [_vm._v("Clicks")]
                        ),
                        _vm._v(" "),
                        _c(
                          "span",
                          {
                            staticClass:
                              "card-counter font-weight-bold transparency"
                          },
                          [_vm._v(_vm._s(listing["ranking"]["clicks"]))]
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "d-flex flex-column justify-content-end",
                        staticStyle: { height: "100%" }
                      },
                      [
                        _c("img", {
                          staticClass: "tw-w-6 tw-h-6 tw-shadow tw-mr-2",
                          attrs: {
                            src: "/img/flags/" + listing.language + ".svg",
                            alt: ""
                          }
                        })
                      ]
                    )
                  ]
                )
              ]),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass:
                    "server-card-body align-items-center tw-shadow-inner px-4 py-3 d-flex"
                },
                [
                  _c(
                    "span",
                    {
                      staticClass: "tw-mr-4 tw-text-grey-darker",
                      staticStyle: { "font-size": "30px" }
                    },
                    [_vm._v(_vm._s(listing["ranking"]["rank"]))]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "tw-border-l-2 tw-pl-4 tw-border-grey-light flex-fill pr-3"
                    },
                    [
                      _c(
                        "p",
                        {
                          staticClass:
                            "tw-text-grey-darkest tw-tracking-tight tw-font-semibold mb-0",
                          staticStyle: { "font-size": "14px" }
                        },
                        [
                          _vm._v(
                            _vm._s(
                              _vm.$t(
                                "homepage.card.rate." +
                                  listing["config"]["title"]
                              )
                            ) + " "
                          ),
                          _c("small", { staticClass: "tw-text-grey-darker" }, [
                            _vm._v(
                              "(" +
                                _vm._s(listing["config"]["base_exp_rate"]) +
                                "x/" +
                                _vm._s(listing["config"]["job_exp_rate"]) +
                                "x)"
                            )
                          ])
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "p",
                        { class: "review-score-" + listing.review_score },
                        [
                          _vm._v(
                            _vm._s(
                              _vm.$t(
                                _vm.reviewScoreMessage(listing.review_score)
                              )
                            )
                          )
                        ]
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "tw-w-1/4 tw-flex tw-justify-end tw-flex-1"
                    },
                    [
                      _c(
                        "at-button",
                        {
                          staticClass: "tw-mr-2 tw-shadow",
                          attrs: { hollow: "" },
                          on: {
                            click: function($event) {
                              return _vm.visit(listing["slug"])
                            }
                          }
                        },
                        [_vm._v("Website")]
                      ),
                      _vm._v(" "),
                      _c(
                        "at-button",
                        {
                          staticClass: "tw-shadow",
                          attrs: { type: "primary" },
                          on: {
                            click: function($event) {
                              return _vm.visit(listing["slug"])
                            }
                          }
                        },
                        [_vm._v("Details")]
                      )
                    ],
                    1
                  )
                ]
              )
            ]
          )
        ]
      )
    }),
    0
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/FilteredListingContainer.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/FilteredListingContainer.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FilteredListingContainer_vue_vue_type_template_id_5520fbff___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FilteredListingContainer.vue?vue&type=template&id=5520fbff& */ "./resources/js/components/FilteredListingContainer.vue?vue&type=template&id=5520fbff&");
/* harmony import */ var _FilteredListingContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FilteredListingContainer.vue?vue&type=script&lang=js& */ "./resources/js/components/FilteredListingContainer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _FilteredListingContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _FilteredListingContainer_vue_vue_type_template_id_5520fbff___WEBPACK_IMPORTED_MODULE_0__["render"],
  _FilteredListingContainer_vue_vue_type_template_id_5520fbff___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/FilteredListingContainer.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/FilteredListingContainer.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/FilteredListingContainer.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FilteredListingContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./FilteredListingContainer.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FilteredListingContainer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FilteredListingContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/FilteredListingContainer.vue?vue&type=template&id=5520fbff&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/FilteredListingContainer.vue?vue&type=template&id=5520fbff& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FilteredListingContainer_vue_vue_type_template_id_5520fbff___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./FilteredListingContainer.vue?vue&type=template&id=5520fbff& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/FilteredListingContainer.vue?vue&type=template&id=5520fbff&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FilteredListingContainer_vue_vue_type_template_id_5520fbff___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FilteredListingContainer_vue_vue_type_template_id_5520fbff___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);