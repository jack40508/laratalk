/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/message.js":
/*!*********************************!*\
  !*** ./resources/js/message.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  //ajax setup for csrf token
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); //Pusher Listener

  Pusher.logToConsole = true;
  var pusher = new Pusher('58eb611363d0e375ea67', {
    cluster: 'mt1'
  });
  var channel = pusher.subscribe('message-channel');
  channel.bind('sent-message-event', function (data) {
    if (my_id == data.from) {
      $('#' + data.to).click();
    } else if (my_id == data.to) {
      if (receiver_id == data.from) {
        //if receiver is selected, reload selected user
        $('#' + data.from).click();
      } else {
        //if receiver isn't selected, add notice
        var pending = parseInt($('#' + data.from).find('.pending').html());
        ;

        if (pending) {
          $('#' + data.from).find('.pending').html(pending + 1);
        } else {
          $('#' + data.from).append('<span class="pending">1</span>');
        }
      }
    }
  }); //chage chat user

  $('.user').click(function () {
    $('.user').removeClass('active');
    $(this).addClass('active');
    $(this).find('.pending').remove();
    receiver_id = $(this).attr('id');
    $.ajax({
      type: "get",
      url: "home/" + receiver_id,
      data: "",
      cache: false,
      success: function success(data) {
        $('#messages').html(data);
        scrollToBottomFunc();
      }
    });
  }); //Sent Message by Button

  $(document).on('click', '.input-text .btn-message', function (e) {
    var message = $('.input-text input').val();

    if (message != '' && receiver_id != '') {
      $('.input-text input').val('');
      sendMessage(message);
    }
  }); //Sent Message by Enter key

  $(document).on('keyup', '.input-text input', function (e) {
    var message = $(this).val(); //Press Enter set message

    if (e.keyCode == 13 && message != '' && receiver_id != '') {
      //clear message text
      $(this).val('');
      sendMessage(message);
    }
  }); //make a function to scroll down auto

  function scrollToBottomFunc() {
    $('.message-wrapper').animate({
      scrollTop: $('.message-wrapper').get(0).scrollHeight
    }, 0.5);
    $('.input-text input').focus();
  } //send message function


  function sendMessage(message) {
    var datastr = "receiver_id=" + receiver_id + "&message=" + message;
    $.ajax({
      type: "post",
      url: "message",
      data: datastr,
      cache: false,
      success: function success(data) {},
      error: function error(jqXHR, status, err) {},
      complete: function complete() {
        scrollToBottomFunc();
      }
    });
  }
});

/***/ }),

/***/ 2:
/*!***************************************!*\
  !*** multi ./resources/js/message.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\laratalk\resources\js\message.js */"./resources/js/message.js");


/***/ })

/******/ });