(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/profile/ProfileConfigs.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/profile/ProfileConfigs.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue_multiselect__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-multiselect */ "./node_modules/vue-multiselect/dist/vue-multiselect.min.js");
/* harmony import */ var vue_multiselect__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_multiselect__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var simple_vue_validator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! simple-vue-validator */ "./node_modules/simple-vue-validator/src/index.js");
/* harmony import */ var simple_vue_validator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(simple_vue_validator__WEBPACK_IMPORTED_MODULE_2__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['defaultDescription'],
  components: {
    Multiselect: vue_multiselect__WEBPACK_IMPORTED_MODULE_1___default.a
  },
  data: function data() {
    return {
      tags: [],
      screenshot: '',
      accents: ['nightmare', 'poring', 'deviling', 'ghostring', 'drops', 'poporing', 'pouring'],
      featureChoices: [],
      commandChoices: [{
        name: '@accept',
        description: 'Accept a duel request from a player'
      }, {
        name: '@afk',
        description: 'placeholder'
      }, {
        name: '@allskill',
        description: 'placeholder'
      }, {
        name: '@alootid',
        description: 'placeholder'
      }, {
        name: '@autobuy',
        description: 'placeholder'
      }, {
        name: '@autoloot',
        description: 'placeholder'
      }, {
        name: '@autotrade',
        description: 'placeholder'
      }, {
        name: '@blvl',
        description: 'placeholder'
      }, {
        name: '@changegm',
        description: 'placeholder'
      }, {
        name: '@commands',
        description: 'placeholder'
      }, {
        name: '@duel',
        description: 'placeholder'
      }, {
        name: '@exp',
        description: 'placeholder'
      }, {
        name: '@feelreset',
        description: 'placeholder'
      }, {
        name: '@go',
        description: 'placeholder'
      }, {
        name: '@guildstorage',
        description: 'placeholder'
      }, {
        name: '@hominfo',
        description: 'placeholder'
      }, {
        name: '@invite',
        description: 'placeholder'
      }, {
        name: '@item',
        description: 'placeholder'
      }, {
        name: '@iteminfo',
        description: 'placeholder'
      }, {
        name: '@jailtime',
        description: 'placeholder'
      }, {
        name: '@jlvl',
        description: 'placeholder'
      }, {
        name: '@jump',
        description: 'placeholder'
      }, {
        name: '@leave',
        description: 'placeholder'
      }, {
        name: '@mobinfo',
        description: 'placeholder'
      }, {
        name: '@rates',
        description: 'placeholder'
      }, {
        name: '@refresh',
        description: 'placeholder'
      }, {
        name: '@request',
        description: 'placeholder'
      }, {
        name: '@showdelay',
        description: 'placeholder'
      }, {
        name: '@showexp',
        description: 'placeholder'
      }, {
        name: '@storage',
        description: 'placeholder'
      }, {
        name: '@time',
        description: 'placeholder'
      }, {
        name: '@warp',
        description: 'placeholder'
      }, {
        name: '@whereis',
        description: 'placeholder'
      }, {
        name: '@who',
        description: 'placeholder'
      }, {
        name: '@whobuy',
        description: 'placeholder'
      }, {
        name: '@whodrops',
        description: 'placeholder'
      }, {
        name: '@whogm',
        description: 'placeholder'
      }, {
        name: '@whosell',
        description: 'placeholder'
      }]
    };
  },
  mounted: function () {
    var _mounted = _asyncToGenerator(
    /*#__PURE__*/
    _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      var _this = this;

      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return this.generatePreset();

            case 2:
              _context.next = 4;
              return axios.get('/api/listing/tags').then(function (response) {
                _this.tags = response.data;
              });

            case 4:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, this);
    }));

    function mounted() {
      return _mounted.apply(this, arguments);
    }

    return mounted;
  }(),
  methods: {
    addTag: function addTag(newTag) {
      var tag = {
        name: newTag,
        description: 'Custom command'
      };
      this.$parent.listing.commands.push(tag);
      this.commandChoices.push(tag);
    },
    addScreenshot: function addScreenshot() {
      if (!_.isEmpty(this.screenshot)) {
        this.$parent.listing.screenshots.push(this.screenshot);
        this.screenshot = '';
      }
    },
    removeScreenshot: function removeScreenshot(index) {
      this.$parent.listing.screenshots.splice(index, 1);
    },
    generatePreset: function generatePreset() {
      this.$parent.preset = _.sample([{
        accent: 'nightmare',
        background: '/img/preset/card-red.png'
      }, {
        accent: 'deviling',
        background: '/img/preset/card-purple.png'
      }, {
        accent: 'poporing',
        background: '/img/preset/card-green.png'
      }, {
        accent: 'pouring',
        background: '/img/preset/card-blue.png'
      }, {
        accent: 'ghostring',
        background: '/img/preset/card-aqua.png'
      }, {
        accent: 'nightmare',
        background: '/img/preset/card-black.png'
      }, {
        accent: 'drops',
        background: '/img/preset/card-mauve.png'
      }, {
        accent: 'poring',
        background: '/img/preset/card-pink.png'
      }]);
    }
  },
  validators: {
    screenshot: function screenshot(value) {
      return simple_vue_validator__WEBPACK_IMPORTED_MODULE_2__["Validator"].value(value).url();
    }
  }
});

/***/ }),

/***/ "./resources/js/components/profile/ProfileConfigs.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/profile/ProfileConfigs.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProfileConfigs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProfileConfigs.vue?vue&type=script&lang=js& */ "./resources/js/components/profile/ProfileConfigs.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var vue_multiselect_dist_vue_multiselect_min_css_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css& */ "./node_modules/vue-multiselect/dist/vue-multiselect.min.css?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProfileConfigs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/profile/ProfileConfigs.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/profile/ProfileConfigs.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/profile/ProfileConfigs.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProfileConfigs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProfileConfigs.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/profile/ProfileConfigs.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProfileConfigs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);