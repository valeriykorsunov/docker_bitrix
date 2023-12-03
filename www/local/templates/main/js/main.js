"use strict";

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e2) { throw _e2; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e3) { didErr = true; err = _e3; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Mask = /*#__PURE__*/function () {
  function Mask(selector) {
    var regExpString = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '+7 (___) ___-__-__';

    _classCallCheck(this, Mask);

    this.elements = document.querySelectorAll(selector);
    this.regExpString = regExpString;
  }

  _createClass(Mask, [{
    key: "init",
    value: function init() {
      this._listeners(this.elements);
    }
  }, {
    key: "_listeners",
    value: function _listeners(selector) {
      for (var i = 0; i < selector.length; i++) {
        var input = selector[i];
        input.addEventListener('input', this._mask.bind(this), false);
        input.addEventListener('focus', this._mask.bind(this), false);
        input.addEventListener('blur', this._mask.bind(this), false);
      }
    }
  }, {
    key: "_setCursorPosition",
    value: function _setCursorPosition(pos, elem) {
      elem.focus();

      if (elem.setSelectionRange) {
        elem.setSelectionRange(pos, pos);
      } else if (elem.createTextRange) {
        var range = elem.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos);
        range.moveStart('character', pos);
        range.select();
      }
    }
  }, {
    key: "_mask",
    value: function _mask(event) {
      var matrix = this.regExpString,
          i = 0,
          def = matrix.replace(/\D/g, ''),
          val = event.target.value.replace(/\D/g, '');

      if (def.length >= val.length) {
        val = def;
      }

      event.target.value = matrix.replace(/./g, function (a) {
        return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
      });

      if (event.type == 'blur') {
        if (event.target.value.length == 2) {
          event.target.value = '';
        }
      } else {
        this._setCursorPosition(event.target.value.length, event.target);
      }
    }
  }]);

  return Mask;
}();

var utils = {
  cache: {
    fileInputs: new Map()
  },
  // сет брейкпоинтов для js
  // должны совпадать с теми что в body:after
  mediaBreakpoint: {
    sm: 576,
    md: 768,
    lg: 1200,
    xl: 1366,
    xxl: 1920
  },
  isMobile: {
    Android: function Android() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function BlackBerry() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function iOS() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function Opera() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function Windows() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function any() {
      return this.Android() || this.BlackBerry() || this.iOS() || this.Opera() || this.Windows();
    }
  },
  svgIcons: function svgIcons() {
    var container = document.querySelector('[data-svg-path]');
    var path = container.getAttribute('data-svg-path');
    var xhr = new XMLHttpRequest();

    xhr.onload = function () {
      container.innerHTML = xhr.responseText;
    };

    xhr.open('get', path, true);
    xhr.send();
  },
  detectIE: function detectIE() {
    /**
     * detect IE
     * returns version of IE or false, if browser is not Internet Explorer
     */
    (function detectIE() {
      var ua = window.navigator.userAgent;
      var msie = ua.indexOf('MSIE ');

      if (msie > 0) {
        // IE 10 or older => return version number
        var ieV = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
        document.querySelector('body').className += ' IE';
      }

      var trident = ua.indexOf('Trident/');

      if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        var ieV = parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
        document.querySelector('body').className += ' IE';
      }

      var edge = ua.indexOf('Edge/');

      if (edge > 0) {
        // IE 12 (aka Edge) => return version number
        var ieV = parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
        document.querySelector('body').className += ' IE';
      } // other browser


      return false;
    })();
  },
  truncateText: function truncateText(elements) {
    var cutText = function cutText() {
      for (var i = 0; i < elements.length; i++) {
        var text = elements[i];
        var elemMaxHeight = parseInt(getComputedStyle(text).maxHeight, 10);
        var elemHeight = text.offsetHeight;
        var maxHeight = elemMaxHeight ? elemMaxHeight : elemHeight;
        shave(text, maxHeight);
      }
    };

    this.cache.cutTextListener = this.throttle(cutText, 100);
    cutText();
    window.addEventListener('resize', this.cache.cutTextListener);
  },
  throttle: function throttle(callback, limit) {
    var wait = false;
    return function () {
      if (!wait) {
        callback.call();
        wait = true;
        setTimeout(function () {
          wait = false;
        }, limit);
      }
    };
  },
  getScreenSize: function getScreenSize() {
    var screenSize = window.getComputedStyle(document.querySelector('body'), ':after').getPropertyValue('content');
    screenSize = parseInt(screenSize.match(/\d+/), 10);
    return screenSize;
  },
  polyfills: function polyfills() {
    /**
     * polyfill for elem.closest
     */
    (function (ELEMENT) {
      ELEMENT.matches = ELEMENT.matches || ELEMENT.mozMatchesSelector || ELEMENT.msMatchesSelector || ELEMENT.oMatchesSelector || ELEMENT.webkitMatchesSelector;

      ELEMENT.closest = ELEMENT.closest || function closest(selector) {
        if (!this) return null;
        if (this.matches(selector)) return this;

        if (!this.parentElement) {
          return null;
        } else {
          return this.parentElement.closest(selector);
        }
      };
    })(Element.prototype);
    /**
     * polyfill for elem.hasClass
     */


    Element.prototype.hasClass = function (className) {
      return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
    };

    Number.isNaN = Number.isNaN || function (value) {
      return typeof value === 'number' && isNaN(value);
    }; // Шаги алгоритма ECMA-262, 6-е издание, 22.1.2.1
    // Ссылка: https://people.mozilla.org/~jorendorff/es6-draft.html#sec-array.from


    if (!Array.from) {
      Array.from = function () {
        var toStr = Object.prototype.toString;

        var isCallable = function isCallable(fn) {
          return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
        };

        var toInteger = function toInteger(value) {
          var number = Number(value);

          if (isNaN(number)) {
            return 0;
          }

          if (number === 0 || !isFinite(number)) {
            return number;
          }

          return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
        };

        var maxSafeInteger = Math.pow(2, 53) - 1;

        var toLength = function toLength(value) {
          var len = toInteger(value);
          return Math.min(Math.max(len, 0), maxSafeInteger);
        }; // Свойство length метода from равно 1.


        return function from(arrayLike
        /*, mapFn, thisArg */
        ) {
          // 1. Положим C равным значению this.
          var C = this; // 2. Положим items равным ToObject(arrayLike).

          var items = Object(arrayLike); // 3. ReturnIfAbrupt(items).

          if (arrayLike == null) {
            throw new TypeError('Array.from requires an array-like object - not null or undefined');
          } // 4. Если mapfn равен undefined, положим mapping равным false.


          var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
          var T;

          if (typeof mapFn !== 'undefined') {
            // 5. иначе
            // 5. a. Если вызов IsCallable(mapfn) равен false, выкидываем исключение TypeError.
            if (!isCallable(mapFn)) {
              throw new TypeError('Array.from: when provided, the second argument must be a function');
            } // 5. b. Если thisArg присутствует, положим T равным thisArg; иначе положим T равным undefined.


            if (arguments.length > 2) {
              T = arguments[2];
            }
          } // 10. Положим lenValue равным Get(items, "length").
          // 11. Положим len равным ToLength(lenValue).


          var len = toLength(items.length); // 13. Если IsConstructor(C) равен true, то
          // 13. a. Положим A равным результату вызова внутреннего метода [[Construct]]
          //     объекта C со списком аргументов, содержащим единственный элемент len.
          // 14. a. Иначе, положим A равным ArrayCreate(len).

          var A = isCallable(C) ? Object(new C(len)) : new Array(len); // 16. Положим k равным 0.

          var k = 0; // 17. Пока k < len, будем повторять... (шаги с a по h)

          var kValue;

          while (k < len) {
            kValue = items[k];

            if (mapFn) {
              A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
            } else {
              A[k] = kValue;
            }

            k += 1;
          } // 18. Положим putStatus равным Put(A, "length", len, true).


          A.length = len; // 20. Вернём A.

          return A;
        };
      }();
    }
  }
};
var states = {
  TYPE_ACTIVE: 'active',
  ITEM_ANIMATED: ['animated-show', 'animated-hide']
};
var elements = {
  FILTERS_TYPE: '[data-type-filter]',
  CURRENT_TYPE: "[data-type-filter].".concat(states.TYPE_ACTIVE),
  ITEMS: '[data-type]'
};

var MyList = /*#__PURE__*/function () {
  function MyList(parent, id) {
    var optionsList = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];

    _classCallCheck(this, MyList);

    this._id = id;
    this._optionsList = optionsList;
    this._parent = parent;
    this.list = [];

    this._initList();
  }

  _createClass(MyList, [{
    key: "_initListPlugin",
    value: function _initListPlugin() {
      var options = {
        valueNames: [{
          data: ['type']
        }]
      };

      if (this._optionsList.length) {
        var _options$valueNames;

        options.valueNames = (_options$valueNames = options.valueNames).concat.apply(_options$valueNames, _toConsumableArray(this._optionsList));
      }

      this.list = new List(this._id, options);
    }
  }, {
    key: "itemsToggleAnimated",
    value: function itemsToggleAnimated(boolean) {
      var list = this._parent.querySelector('.js-list');

      if (boolean) {
        list.classList.remove(states.ITEM_ANIMATED[1]);
        list.classList.add(states.ITEM_ANIMATED[0]);
      } else {
        list.classList.remove(states.ITEM_ANIMATED[0]);
        list.classList.add(states.ITEM_ANIMATED[1]);
      }
    }
  }, {
    key: "filterList",
    value: function filterList() {
      var currentType = this._parent.querySelector(elements.CURRENT_TYPE).dataset.typeFilter;

      if (currentType !== 'all') {
        this.list.filter(function (item) {
          return currentType === item.values().type;
        });
      } else {
        this.list.filter();
      }

      this.itemsToggleAnimated(true);
    }
  }, {
    key: "navItemRemoveActive",
    value: function navItemRemoveActive() {
      var navItemsArr = Array.from(this._parent.querySelectorAll(elements.FILTERS_TYPE));
      navItemsArr.forEach(function (item) {
        item.classList.remove(states.TYPE_ACTIVE);
      });
    }
  }, {
    key: "_initList",
    value: function _initList() {
      if (!document.getElementById(this._id)) {
        console.error("\u041D\u0435 \u043D\u0430\u0439\u0434\u0435\u043D \u0441\u043F\u0438\u0441\u043E\u043A \u0441 id=".concat(this._id));
        return;
      }

      this._initListPlugin();

      this.filterList();
    }
  }, {
    key: "id",
    get: function get() {
      return this._id;
    }
  }]);

  return MyList;
}();

var CheckboxSelect = /*#__PURE__*/function () {
  function CheckboxSelect(el) {
    _classCallCheck(this, CheckboxSelect);

    this.el = el;
    this.toggle = this.el.querySelector('.js-select-checkbox-toggle');
    this.valueEl = this.el.querySelector('.js-select-checkbox-value');
    this.checkboxes = Array.from(this.el.querySelectorAll('input[type="checkbox"]'));
  }

  _createClass(CheckboxSelect, [{
    key: "init",
    value: function init() {
      var _this = this;

      var that = this;
      this.valueEl.textContent = this.checkboxes.filter(function (item) {
        return item.checked;
      }).length;
      this.toggle.addEventListener('click', function (e) {
        _this.el.classList.toggle('active');
      });
      this.checkboxes.forEach(function (item) {
        item.addEventListener('change', _this.changeCurrentValue.bind(_this));
      });
      document.addEventListener('click', function (e) {
        if (!$(e.target).closest(that.el).length && that.el.classList.contains('active')) {
          that.el.classList.remove('active');
        }
      });
    }
  }, {
    key: "changeCurrentValue",
    value: function changeCurrentValue() {
      this.valueEl.textContent = this.checkboxes.filter(function (item) {
        return item.checked;
      }).length;
    }
  }, {
    key: "documentClickHandler",
    value: function documentClickHandler() {}
  }]);

  return CheckboxSelect;
}();

var FileInput = /*#__PURE__*/function () {
  _createClass(FileInput, null, [{
    key: "createImage",
    value: function createImage(file) {
      var img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.alt = file.name;
      img.setAttribute('data-object-fit', 'cover');
      return img;
    }
  }, {
    key: "createVideo",
    value: function createVideo(file) {
      var video = document.createElement('video');
      video.src = URL.createObjectURL(file);
      video.setAttribute('data-object-fit', 'cover');
      return video;
    }
  }, {
    key: "createListItem",
    value: function createListItem(file, index) {
      var div = document.createElement('div');
      div.className = 'file-input__item responsive-img';
      div.setAttribute('data-index', index);

      if (/^image\//.test(file.type)) {
        div.append(FileInput.createImage(file));
      } else if (/^video\//.test(file.type)) {
        div.append(FileInput.createVideo(file));
      }

      return div;
    }
  }]);

  function FileInput(el) {
    _classCallCheck(this, FileInput);

    this._files = [];
    this.el = el;
    this.max = el.dataset.max;
    this.input = el.querySelector('.js-file-input-control'); // this.imageList = el.querySelector('.js-file-input-list');

    this.dropdown = el.querySelector('.js-file-input-dropdown');
    this.dropdownValue = this.dropdown.querySelector('.js-file-input-dropdown-value');
    this.dropdownList = this.dropdown.querySelector('.js-file-input-dropdown-list');
    this.input.addEventListener('change', this.addFiles.bind(this));
  }

  _createClass(FileInput, [{
    key: "getFiles",
    value: function getFiles() {
      return this._files;
    }
  }, {
    key: "addFiles",
    value: function addFiles() {
      var newFiles = this.input.files;

      var _iterator = _createForOfIteratorHelper(newFiles),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var file = _step.value;
          var listItem = FileInput.createListItem(file, this._files.length);

          this._files.push(file);

          if (this._files.length <= this.max) {
            this.dropdown.before(listItem);
          } else {
            this.updateDropdown(listItem);
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }
  }, {
    key: "updateDropdown",
    value: function updateDropdown(el) {
      this.dropdownValue.innerText = "+".concat(this._files.length - this.max);
      this.dropdownList.append(el);

      if (this.dropdown.classList.contains('hidden')) {
        this.dropdown.classList.remove('hidden');
      }
    }
  }]);

  return FileInput;
}();

var APP = {
  initBefore: function initBefore() {
    utils.polyfills();
    utils.svgIcons();
    document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
  },
  init: function init() {
    utils.detectIE();
    APP.lazyload();
    var myMask = new Mask('.js-tel');
    myMask.init();
    APP.buttons(); // APP.closeOnFocusLost();

    this.initParallax();
    this.initFirstSlider();
    this.initReviewsSlider();
    this.initArticlesSlider();
    this.initProfileSlider();
    this.initAccordion();
    this.initCalendar();
    this.initTabs();
    this.initPriceList();
    this.addFormValidate();
    this.initSelect();
    this.initStarsSelect();
    this.initRatingSelect();
    this.initCheckboxSelect();
    this.initPerformersMap();
    this.initPerformersFilter();
    this.initRangeSLider();
    this.initModals();
    this.initGallery();
    this.initFileInput();
    this.initAvatarInput();
    this.initScrollBlock();
    this.initAddPetBlock();
    this.initPetCardEvents();
    this.initBirthdayCalendar();
    this.initDeleteBlock();
  },
  initOnLoad: function initOnLoad() {
    utils.truncateText(document.querySelectorAll('.js-dot'));
  },
  buttons: function buttons() {
    Array.prototype.forEach.call(document.querySelectorAll('.js-mobile-menu-button'), function (item) {
      item.addEventListener('click', function () {
        document.body.classList.toggle('nav-showed');
      });
    });
    Array.from(document.querySelectorAll('.js-link-anchor')).forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        var position = $($(e.currentTarget).attr('href')).offset().top;
        $('html, body').animate({
          scrollTop: "".concat(position, "px")
        }, {
          duration: 500,
          easing: 'swing'
        });
      });
    });
  },
  // closeOnFocusLost() {
  //   document.addEventListener('click', (e) => {
  //     const trg = e.target;
  //     if (!trg.closest('.header')) {
  //       document.body.classList.remove('nav-showed');
  //     }
  //   });
  // },
  lazyload: function lazyload() {
    function update() {
      APP.myLazyLoad.update();
      APP.objectFitFallback(document.querySelectorAll('[data-object-fit]'));
    }

    function regularInit() {
      APP.myLazyLoad = new LazyLoad({
        elements_selector: '.lazyload',
        callback_error: function callback_error(el) {
          el.parentElement.classList.add('lazyload-error');
        }
      });
      APP.objectFitFallback(document.querySelectorAll('[data-object-fit]'));
    }

    if (typeof APP.myLazyLoad === 'undefined') {
      regularInit();
    } else {
      update();
    }
  },
  objectFitFallback: function objectFitFallback(selector) {
    // if (true) {
    if ('objectFit' in document.documentElement.style === false) {
      for (var i = 0; i < selector.length; i++) {
        var that = selector[i];
        var imgUrl = that.getAttribute('src') ? that.getAttribute('src') : that.getAttribute('data-src');
        var dataFit = that.getAttribute('data-object-fit');
        var fitStyle = void 0;

        if (dataFit === 'cover') {
          fitStyle = 'cover';
        } else {
          fitStyle = 'contain';
        }

        var parent = that.parentElement;

        if (imgUrl) {
          parent.style.backgroundImage = "url(".concat(imgUrl, ")");
          parent.classList.add('fit-img');
          parent.classList.add("fit-img--".concat(fitStyle));
        }
      }
    }
  },
  initParallax: function initParallax() {
    var scenes = Array.from(document.querySelectorAll('.js-scene'));
    scenes.forEach(function (item) {
      var parallaxInstance = new Parallax(item);
    });
  },
  initFirstSlider: function initFirstSlider() {
    var sliderBlock = document.querySelector('.js-first-slider');

    if (sliderBlock) {
      var firstSlider = new Swiper(sliderBlock, {
        speed: 800,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        watchOverflow: true,
        navigation: {
          prevEl: '.js-first-prev-button',
          nextEl: '.js-first-next-button'
        },
        pagination: {
          el: '.js-first-pagination'
        }
      });
    }
  },
  initReviewsSlider: function initReviewsSlider() {
    var sliderBlock = document.querySelector('.js-reviews-slider');
    var thumbSLiderBlock = document.querySelector('.js-thumb-reviews-slider');

    if (sliderBlock && thumbSLiderBlock) {
      var thumbSLider = new Swiper(thumbSLiderBlock, {
        watchOverflow: true,
        speed: 800,
        effect: 'fade',
        allowTouchMove: false,
        fadeEffect: {
          crossFade: true
        }
      });
      var slider = new Swiper(sliderBlock, {
        watchOverflow: true,
        speed: 800,
        spaceBetween: 30,
        thumbs: {
          swiper: thumbSLider
        },
        navigation: {
          prevEl: '.js-reviews-prev-button',
          nextEl: '.js-reviews-next-button'
        },
        pagination: {
          el: '.js-reviews-pagination'
        }
      });
    }
  },
  initArticlesSlider: function initArticlesSlider() {
    var sliderBlock = document.querySelector('.js-articles-slider');

    if (sliderBlock) {
      var articlesSlider = new Swiper(sliderBlock, {
        speed: 800,
        watchOverflow: true,
        spaceBetween: 43,
        slidesPerView: 1,
        navigation: {
          prevEl: '.js-articles-prev-button',
          nextEl: '.js-articles-next-button'
        },
        pagination: {
          el: '.js-articles-pagination'
        },
        breakpoints: {
          1200: {
            slidesPerView: 3
          }
        }
      });
    }
  },
  initProfileSlider: function initProfileSlider() {
    var sliderBlock = document.querySelector('.js-profile-slider');

    if (sliderBlock) {
      var profileSlider = new Swiper(sliderBlock, {
        speed: 800,
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
          prevEl: '.js-profile-prev',
          nextEl: '.js-profile-next'
        },
        breakpoints: {
          768: {
            slidesPerView: 'auto'
          }
        }
      });
    }
  },
  initAccordion: function initAccordion() {
    if (document.querySelector('.js-accordion')) {
      var accordion = new Accordion('.js-accordion', {
        closeOthers: false
      });
    }
  },
  initCalendar: function initCalendar() {
    var calendarBlocks = Array.from(document.querySelectorAll('.js-calendar'));

    if (calendarBlocks.length) {
      calendarBlocks.forEach(function (calendar) {
        var datePicker = calendar.querySelector('.js-datepicker');
        var startDateinput = calendar.querySelector('.js-start-date');
        var endDateinput = calendar.querySelector('.js-end-date');
        $(datePicker).datepicker({
          range: true,
          dateFormat: 'dd.mm.yyyy',
          minDate: new Date(),
          onSelect: function onSelect(formattedDate) {
            var _formattedDate$split = formattedDate.split(','),
                _formattedDate$split2 = _slicedToArray(_formattedDate$split, 2),
                startDate = _formattedDate$split2[0],
                endDate = _formattedDate$split2[1];

            startDateinput.value = startDate;

            if (endDate) {
              endDateinput.value = endDate;
            }
          }
        });
      });
    }
  },
  initBirthdayCalendar: function initBirthdayCalendar() {
    var el = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    var calendars = Array.from(el.querySelectorAll('.js-weekend-calendar'));

    if (calendars.length) {
      calendars.forEach(function (item) {
        var myDate = item.dataset.myDate;
        $(item).datepicker({
          autoClose: true
        });

        if (myDate) {
          $(item).datepicker().data('datepicker').selectDate(new Date(myDate));
        }
      });
    }
  },
  initTabs: function initTabs() {
    var tabBlocks = Array.from(document.querySelectorAll('.js-tabs'));

    if (tabBlocks.length) {
      tabBlocks.forEach(function (block) {
        $(block).responsiveTabs({
          duration: 500,
          setHash: block.hasAttribute('data-hash'),
          activate: function activate(evt, tab) {
            var tabThumb = block.querySelector('.js-tabs-thumb');

            if (tabThumb) {
              setTimeout(function () {
                var activeTab = tab.tab[0];
                var navigationCoords = activeTab.parentElement.getBoundingClientRect();
                var activeTabCoords = activeTab.getBoundingClientRect();
                tabThumb.style.width = "".concat(activeTab.offsetWidth, "px");
                tabThumb.style.left = "".concat(activeTabCoords.left - navigationCoords.left, "px");
              }, 100);
            }
          }
        });
      });
    }
  },
  initPriceList: function initPriceList() {
    var listBlock = document.querySelector('.js-price-list');

    if (listBlock) {
      var listToggles = Array.from(listBlock.querySelectorAll('.js-list-toggle'));
      var priceList = new MyList(listBlock, listBlock.dataset.id);
      listToggles.forEach(function (item) {
        item.addEventListener('click', function (evt) {
          evt.preventDefault();

          if (!evt.currentTarget.classList.contains('active')) {
            priceList.navItemRemoveActive();
            priceList.itemsToggleAnimated(false);
            evt.currentTarget.classList.add('active');
            priceList.filterList();
          }
        });
      });
    }
  },
  addFormValidate: function addFormValidate() {
    var _this2 = this;

    var forms = Array.from(document.querySelectorAll('form.js-validate'));

    if (forms.length) {
      forms.forEach(function (el) {
        if (!el.classList.contains('validation')) {
          _this2.formValidate(el);
        }
      });
    }
  },
  formValidate: function formValidate(el) {
    var $form = $(el);
    el.classList.add('validation');

    $.validator.methods.email = function (value, element) {
      return this.optional(element) || /[a-z]+@[a-z]+\.[a-z]+/.test(value);
    };

    $.validator.addMethod('compareValue', function (value, element) {
      var compareValue = this.findByName(element.dataset.compareName).val();
      return value === compareValue;
    });
    $form.validate({
      wrapper: 'p',
      errorElement: 'span',
      rules: {
        phone: {
          mobileRU: true
        },
        email: {
          email: true
        },
        passwordRepeat: {
          compareValue: true
        },
        'repeat-new-pass': {
          compareValue: true
        }
      },
      errorPlacement: function errorPlacement(error, element) {
        if (element.attr('type') === 'checkbox') {
          return element.next('label').append(error);
        }

        return false;
      },
      highlight: function highlight(element) {
        $(element).addClass('error').parent().addClass('error');
      },
      unhighlight: function unhighlight(element) {
        $(element).removeClass('error').parent().removeClass('error');
      },
      submitHandler: function submitHandler(form) {
        var formData = new FormData(form);
        var fileInput = form.querySelector('.js-file-input');

        if (fileInput) {
          var cacheFileInput = utils.cache.fileInputs.get(fileInput);
          formData.set('files', cacheFileInput.getFiles());
        }

        $.ajax({
          url: form.action,
          data: formData,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function success(data) {
            form.reset();
            $.magnificPopup.close();
			if (typeof successPost === 'function') successPost(data);
          }
        });
      }
    });
  },
  selectOptions: {
    minimumResultsForSearch: Infinity,
    width: 'resolve'
  },
  initSelect: function initSelect(el) {
    var doc = el || document;
    var selects = Array.from(doc.querySelectorAll('.js-select'));

    if (selects.length) {
      var options = _objectSpread({}, APP.selectOptions);

      selects.forEach(function (item) {
        if (item.hasAttribute('data-placeholder')) {
          APP.selectOptions.placeholder = item.dataset.placeholder;
        }

        $(item).select2(_objectSpread(_objectSpread({}, options), {}, {
          dropdownParent: $(item).parent()
        }));
        $(item).on('select2:select', function (e) {
          var select = e.currentTarget;
          select.classList.remove('error');
          select.parentElement.classList.remove('error');
        });
      });
    }
  },
  initStarsSelect: function initStarsSelect() {
    var selectStars = Array.from(document.querySelectorAll('.js-select-stars'));

    var formatStarState = function formatStarState(state) {
      if (!state.id) {
        return state.text;
      }

      var MAX_STARS = 5;
      var element = state.element;
      var _element$dataset = element.dataset,
          stars = _element$dataset.stars,
          quantity = _element$dataset.quantity;
      var starString = '';

      for (var i = 1; i <= MAX_STARS; i++) {
        if (i > stars) {
          starString += '<span class="star"><i class="fas fa-star"></i></span>';
        } else {
          starString += '<span class="star star--yellow"><i class="fas fa-star"></i></span>';
        }
      }

      return $("<span>".concat(starString, " (").concat(quantity, ")</span>"));
    };

    if (selectStars.length) {
      var options = _objectSpread({}, APP.selectOptions);

      selectStars.forEach(function (item) {
        if (item.hasAttribute('data-placeholder')) {
          options.placeholder = item.dataset.placeholder;
        }

        $(item).select2(_objectSpread(_objectSpread({}, options), {}, {
          dropdownParent: $(item).parent(),
          templateResult: formatStarState,
          templateSelection: formatStarState
        }));
        $(item).on('select2:select', function (e) {
          var select = e.currentTarget;
          select.classList.remove('error');
          select.parentElement.classList.remove('error');
        });
      });
    }
  },
  initRatingSelect: function initRatingSelect() {
    var selectRating = Array.from(document.querySelectorAll('.js-select-rating'));

    var formatStarStateResult = function formatStarStateResult(state) {
      if (!state.id) {
        return 'state.text';
      }

      var element = state.element;
      var stars = element.dataset.stars;
      var starString = '';

      for (var i = 1; i <= stars; i++) {
        starString += '<span class="star star--yellow"><i class="fas fa-star"></i></span>';
      }

      return $("<span>".concat(starString, "</span>"));
    };

    var formatStarStateSelection = function formatStarStateSelection(state) {
      if (!state.id) {
        return state.text;
      }

      var element = state.element;
      var stars = element.dataset.stars;
      var starString = '';

      for (var i = 1; i <= stars; i++) {
        starString += '<span class="star star--yellow"><i class="fas fa-star"></i></span>';
      }

      return $("<span>\u0420\u0435\u0439\u0442\u0438\u043D\u0433 \u043E\u0442 ".concat(starString, "</span>"));
    };

    if (selectRating.length) {
      var options = _objectSpread({}, APP.selectOptions);

      selectRating.forEach(function (item) {
        if (item.hasAttribute('data-placeholder')) {
          options.placeholder = item.dataset.placeholder;
        }

        $(item).select2(_objectSpread(_objectSpread({}, options), {}, {
          dropdownParent: $(item).parent(),
          templateResult: formatStarStateResult,
          templateSelection: formatStarStateSelection
        }));
        $(item).on('select2:select', function (e) {
          var select = e.currentTarget;
          select.classList.remove('error');
          select.parentElement.classList.remove('error');
        });
      });
    }
  },
  performersDataMap: {
    sticky: null
  },
  initPerformersMap: function initPerformersMap() {
    var stickyMap = document.querySelector('.js-sticky-map');

    if (stickyMap) {
      if (utils.getScreenSize() >= utils.mediaBreakpoint.lg) {
        this.performersDataMap.sticky = new Sticky('.js-sticky-map');
      }

      window.addEventListener('resize', function () {
        if (utils.getScreenSize() >= utils.mediaBreakpoint.lg && !APP.performersDataMap.sticky) {
          APP.performersDataMap.sticky = new Sticky('.js-sticky-map');
        } else if (utils.getScreenSize() < utils.mediaBreakpoint.lg && APP.performersDataMap.sticky) {
          APP.performersDataMap.sticky.destroy();
          APP.performersDataMap.sticky = null;
        }
      });
    }
  },
  initPerformersFilter: function initPerformersFilter() {
    var filter = document.querySelector('.js-performers-filter');

    if (filter) {
      var toggleButton = filter.querySelector('.js-performers-filter-toggle');
      toggleButton.addEventListener('click', function (e) {
        e.preventDefault();
        filter.classList.toggle('active');
      });
    }
  },
  initCheckboxSelect: function initCheckboxSelect() {
    var selects = Array.from(document.querySelectorAll('.js-select-checkbox'));

    if (selects.length) {
      selects.forEach(function (item) {
        var select = new CheckboxSelect(item);
        select.init();
      });
    }
  },
  initRangeSLider: function initRangeSLider() {
    var sliders = Array.from(document.querySelectorAll('.js-range'));

    if (sliders.length) {
      sliders.forEach(function (item) {
        var inputs = Array.from(item.parentElement.querySelectorAll('.js-range-value'));
        var _item$dataset = item.dataset,
            min = _item$dataset.min,
            max = _item$dataset.max,
            step = _item$dataset.step,
            startMin = _item$dataset.startMin,
            startMax = _item$dataset.startMax;
        noUiSlider.create(item, {
          start: [parseFloat(startMin), parseFloat(startMax)],
          connect: true,
          step: parseFloat(step),
          range: {
            min: parseFloat(min),
            max: parseFloat(max)
          },
          tooltips: [true, true],
          format: wNumb({
            decimals: step > 0 ? 0 : 1
          })
        });

        if (inputs.length) {
          var inputMin = inputs[0];
          var inputMax = inputs[1];
          item.noUiSlider.on('update', function (values, handle) {
            var value = values[handle];

            if (handle) {
              inputMax.value = value;
            } else {
              inputMin.value = value;
            }
          });
        }
      });
    }
  },
  initModals: function initModals() {
    var callbacks = {
      ajaxContentAdded: function ajaxContentAdded() {
        var $modalContent = $(this.content);

        if ($modalContent.find('.js-validate').length) {
          $modalContent.find('.js-validate').each(function (id, el) {
            APP.formValidate(el);
          });
        }

        if ($modalContent.find('.js-select').length) {
          APP.initSelect(this.content[0]);
        }

        if ($modalContent.find('.js-tel')) {
          var myMask = new Mask('.js-tel');
          myMask.init();
        }

        if ($modalContent.find('.js-file-input')) {
          var fileInputs = utils.cache.fileInputs;
          $modalContent.find('.js-file-input').each(function (id, el) {
            fileInputs.set(el, new FileInput(el));
          });
        }
      },
      open: function open() {
        document.body.classList.remove('nav-showed');
      },
      close: function close() {
        var $modalContent = $(this.content);

        if ($modalContent.find('.js-file-input')) {
          var fileInputs = utils.cache.fileInputs;
          $modalContent.find('.js-file-input').each(function (id, el) {
            fileInputs.delete(el);
          });
        }
      }
    };
    var options = {
      removalDelay: 500,
      mainClass: 'mfp-fade',
      fixedContentPos: true,
      fixedBgPos: true,
      showCloseBtn: false
    };
    $('.js-ajax-modal').magnificPopup(_objectSpread({
      type: 'ajax',
      callbacks: callbacks
    }, options));
    $('.js-inline-modal').magnificPopup(_objectSpread(_objectSpread({
      type: 'inline'
    }, options), {}, {
      callbacks: {
        open: function open() {
          var $modalContent = $(this.content);

          if ($modalContent.find('.js-tabs')) {
            $modalContent.find('.js-tabs').each(function (id, el) {
              $(el).responsiveTabs('activate', 0);
            });
          }
        }
      }
    }));
  },
  initGallery: function initGallery() {
    var galleries = Array.from(document.querySelectorAll('.js-gallery'));

    if (galleries.length) {
      galleries.forEach(function (gallery) {
        $(gallery).magnificPopup({
          type: 'image',
          delegate: 'a',
          removalDelay: 500,
          mainClass: 'mfp-fade',
          fixedContentPos: true,
          fixedBgPos: true,
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
          },
          callbacks: {
            elementParse: function elementParse(item) {
              var type = item.el[0].dataset.type;
              item.type = type;
            }
          }
        });
      });
    }
  },
  initFileInput: function initFileInput(el) {
    var fileInputs = utils.cache.fileInputs;
    var doc = el || document;
    var elements = Array.from(doc.querySelectorAll('.js-file-input'));

    if (elements.length) {
      elements.forEach(function (item) {
        fileInputs.set(item, new FileInput(item));
      });
    }
  },
  initAvatarInput: function initAvatarInput() {
    var avatarInputs = Array.from(document.querySelectorAll('.js-avatar-input'));

    function createImage() {
      var img = document.createElement('img');
      img.setAttribute('data-object-fit', 'cover');
      return img;
    }

    if (avatarInputs.length) {
      avatarInputs.forEach(function (inputBlock) {
        inputBlock.addEventListener('change', function (e) {
          var file = e.target.files[0];
          var img = e.currentTarget.querySelector('img');

          if (img) {
            img.src = URL.createObjectURL(file);
          } else {
            img = createImage();
            img.src = URL.createObjectURL(file);
            e.currentTarget.querySelector('.js-avatar-image').append(img);
          }
        });
      });
    }
  },
  initScrollBlock: function initScrollBlock() {
    var scrollBlocks = Array.from(document.querySelectorAll('.js-scroll-block'));

    if (scrollBlocks.length) {
      scrollBlocks.forEach(function (item) {
        var _item$dataset$axis = item.dataset.axis,
            axis = _item$dataset$axis === void 0 ? 'y' : _item$dataset$axis;
        $(item).mCustomScrollbar({
          axis: axis
        });
      });
    }
  },
  initAddPetBlock: function initAddPetBlock(getFun = false) {
    var addPetBlock = document.querySelector('.js-add-pet');

    function toggleAddPetBlock() {
      var _addPetBlock$getBound = addPetBlock.getBoundingClientRect(),
          width = _addPetBlock$getBound.width,
          left = _addPetBlock$getBound.left;
      var clientWidth = document.documentElement.clientWidth;
      var translateX = clientWidth - left - width;
      addPetBlock.style.transform = "translate3d(".concat(translateX, "px, 0, 0)");
	  addPetBlock.classList.toggle('active');
    }

    function closeAddPetBlock() {
      addPetBlock.style.transform = 'translate3d(0, 0, 0)';
      addPetBlock.classList.remove('active');
    }

	if(getFun){
		return {
			addPetBlock: addPetBlock,
			toggleAddPetBlock: toggleAddPetBlock,
			closeAddPetBlock: closeAddPetBlock
		};
	}

	if (addPetBlock) {
      var toggleButton = document.querySelector('.js-add-pet-toggle');
      toggleButton.addEventListener('click', function (e) {
        e.preventDefault();
        toggleAddPetBlock();
      });
    //   document.addEventListener('click', function (e) {
    //     if (!e.target.closest('.js-add-pet.active') && !e.target.classList.contains('b-personal-pet-card__edit_button')  && addPetBlock.classList.contains('active')) {
    //       closeAddPetBlock();
    //     }
    //   });
      window.addEventListener('resize', function () {
        if (addPetBlock.classList.contains('active')) {
          closeAddPetBlock();
        }
      });
    }
  },
  initDeleteBlock: function initDeleteBlock() {
    var el = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : document;
    var CONTENT_PADDING_BOTTOM = 40;
    var blocks = Array.from(el.querySelectorAll('.js-delete'));

    function toggleActiveDeleteHandler(e) {
      e.preventDefault();
      var deleteBlock = e.currentTarget.closest('.js-delete');
      var _deleteBlock$getBound = deleteBlock.getBoundingClientRect(),
	  top = _deleteBlock$getBound.top,
	  height = _deleteBlock$getBound.height;
	  
      var deleteDropdown = deleteBlock.querySelector('.js-delete-dropdown');
      var isTopDropdown = document.documentElement.clientHeight - height - top - CONTENT_PADDING_BOTTOM < deleteDropdown.offsetHeight;
      blocks.filter(function (item) {
        return item.classList.contains('active') && item !== deleteBlock;
      }).forEach(function (item) {
        return item.classList.remove('active');
      });

      if (!deleteBlock.classList.contains('active')) {
        if (isTopDropdown) {
          deleteDropdown.classList.add('b-delete__dropdown--top');
        } else {
          deleteDropdown.classList.remove('b-delete__dropdown--top');
        }
      }

      deleteBlock.classList.toggle('active');
    }

    function closeDeleteHandler(e) {
      e.preventDefault();
      var deleteBlock = e.currentTarget.closest('.js-delete');
      deleteBlock.classList.remove('active');
    }

    function deleteHandler(e) {
      e.preventDefault();
      var deleteButton = e.currentTarget;
      var deleteBlock = deleteButton.closest('.js-delete');
      var _deleteButton$dataset = deleteButton.dataset,
          classElement = _deleteButton$dataset.classElement,
          url = _deleteButton$dataset.url;
      var deleteElement = deleteBlock.closest(".".concat(classElement));
      deleteElement.classList.add('deleted');
      deleteBlock.classList.remove('active');
      $.get(url).done(function () {
        var toggleButton = deleteBlock.querySelector('.js-delete-toggle');
        var noButton = deleteBlock.querySelector('.js-delete-no');
        var yesButton = deleteBlock.querySelector('.js-delete-yes');
        toggleButton.removeEventListener('click', toggleActiveDeleteHandler);
        noButton.removeEventListener('click', closeDeleteHandler);
        yesButton.removeEventListener('click', deleteHandler);
        deleteElement.remove();
      }).fail(function () {
        deleteElement.classList.remove('deleted');
      });

	  // для Safety
	  if (typeof showDocuments === 'function') showDocuments();
    }

    if (blocks.length) {
      blocks.forEach(function (block) {
        var toggle = block.querySelector('.js-delete-toggle');
        var noButton = block.querySelector('.js-delete-no');
        var yesButton = block.querySelector('.js-delete-yes');
        toggle.addEventListener('click', toggleActiveDeleteHandler);
        noButton.addEventListener('click', closeDeleteHandler);
		/* 2021-10-28 modification ->*/
		if (!document.getElementById('js-applications-page')) {
        	yesButton.addEventListener('click', deleteHandler);
		}
		/* <- modification 2021-10-28 */
      });
      document.addEventListener('click', function (e) {
        if (!e.target.closest('.js-delete.active')) {
          blocks.filter(function (item) {
            return item.classList.contains('active');
          }).forEach(function (item) {
            return item.classList.remove('active');
          });
        }
      });
    }
  },
  initPetCardEvents: function initPetCardEvents() {
    var _this3 = this;

    var cards = Array.from(document.querySelectorAll('.js-pet-card'));

    if (cards.length) {
      cards.forEach(function (item) {
        var toggleButton = item.querySelector('.js-pet-card-toggle');
        var hideBlock = item.querySelector('.js-pet-card-hide');
        var _toggleButton$dataset = toggleButton.dataset,
            activeContent = _toggleButton$dataset.activeContent,
            inactiveContent = _toggleButton$dataset.inactiveContent;
        toggleButton.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var activeCards = Array.from(document.querySelectorAll('.js-pet-card.active')).filter(function (card) {
            return card !== item;
          });

          if (activeCards.length) {
            activeCards.forEach(function (card) {
              var hideBlockOther = card.querySelector('.js-pet-card-hide');
              card.classList.remove('active');
              $(hideBlockOther).slideUp();
            });
          }

          item.classList.toggle('active');

          if (item.classList.contains('active')) {
            $(hideBlock).slideDown();
            _this3.textContent = activeContent;
          } else {
            $(hideBlock).slideUp();
            _this3.textContent = inactiveContent;
          }
        });
      });
      document.addEventListener('click', function (e) {
        if (!e.target.closest('.js-pet-card.active')) {
          var activeEl = document.querySelector('.js-pet-card.active');

          if (activeEl) {
            var hideBlock = activeEl.querySelector('.js-pet-card-hide');
            var toggleButton = activeEl.querySelector('.js-pet-card-toggle');
            var inactiveContent = toggleButton.dataset.inactiveContent;
            activeEl.classList.remove('active');
            $(hideBlock).slideUp();
            toggleButton.textContent = inactiveContent;
          }
        }
      });
    }
  }
};
APP.initBefore();
document.addEventListener('DOMContentLoaded', function () {
  APP.init();
});

window.onload = function () {
  APP.initOnLoad();
};
//# sourceMappingURL=main.js.map

