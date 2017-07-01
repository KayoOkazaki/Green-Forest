//----------------------------------------------------------
// グローバルナビを固定表示にする
//----------------------------------------------------------
$(function() {
    var nav = $('#globalNavi'),
    offset = nav.offset();
    $(window).scroll(function () {
      if($(window).scrollTop() > offset.top) {
        nav.addClass('fixed');
      } else {
        nav.removeClass('fixed');
      }
    });
});
//----------------------------------------------------------
// スクロールが500pxを超えた時、戻るボタン表示
//----------------------------------------------------------
$(window).scroll(function(){
     if ($(window).scrollTop() > 500){
        $("#page-top").fadeIn();
     }else{
        $("#page-top").fadeOut();
     }
});
$("#move-page-top").click(function(){
     $("html,body").animate({scrollTop: 0}, 350);
});
//----------------------------------------------------------------------------
// リンクをクリックした時、ヘッダの高さ分ページTOPの位置をずらして移動する。（ページ内リンクの飛び先位置ズレを解消）
//----------------------------------------------------------------------------
// $(function () {
//  var headerHight = 570; //ヘッダの高さ
//  $('a').click(function(){
//      var href= $(this).attr("href");
//        var target = $(href == "#" || href == "" ? 'html' : href);
//         var position = target.offset().top　-　headerHight; //ヘッダの高さ分位置をずらす
//         alert('position:' + position);
//      $("html, body").animate({scrollTop:position}, 550, "swing");
//         return false;
//    });
// });
//-------------------------------------------------------------------
// 機能説明 ： スクロールイベント用jQueryプラグインを使用した表示エフェクト
//
// JQueryプラグイン ： jquery.inview.js（スクロールイベント）
// 　　　ブラウザの画面上で要素が見えたとき・画面から外れたときに発生するイベント
// CSS          ： jquery.inview.css
//------------------------------------------------------------------
// ズームイン表示 ： 要素が表示されるエリアまでスクロールしたら、ズームインしながら要素を表示
//-------------------------------------------------------------------
$(function() {
    $('.list-mv01').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv01');
        }
        else{
            $(this).stop().removeClass('mv01');
        }
    });
});

//------------------------------------------------------------------
// フェードイン表示 ： 要素が表示されるエリアまでスクロールしたら、フェードインしながら要素を表示
//-------------------------------------------------------------------
$(function() {
    $('.list-mv02').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv02');
        }
        else{
            $(this).stop().removeClass('mv02');
        }
    });
});
//------------------------------------------------------------------
// 3D回転 ： 要素が表示されるエリアまでスクロールしたら、3D回転しながら要素を表示
//-------------------------------------------------------------------
$(function() {
    $('.list-mv03').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv03');
        }
        else{
            $(this).stop().removeClass('mv03');
        }
    });
});
//------------------------------------------------------------------
// 回転表示 ： 要素が表示されるエリアまでスクロールしたら、回転しながら要素を表示します。
//-------------------------------------------------------------------
$(function() {
    $('.list-mv04').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv04');
        }
        else{
            $(this).stop().removeClass('mv04');
        }
    });
});
//------------------------------------------------------------------
// 上移動 ： 要素が表示されるエリアまでスクロールしたら、上移動しながら要素を表示
//-------------------------------------------------------------------
$(function() {
    $('.list-mv05').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv05');
        }
        else{
            $(this).stop().removeClass('mv05');
        }
    });
});
//------------------------------------------------------------------------------
// 3D回転＋ズームイン ： 要素が表示されるエリアまでスクロールしたら、3D回転＋ズームイン表示しながら要素を表示
//-------------------------------------------------------------------------------
$(function() {
    $('.list-mv06').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv06');
        }
        else{
            $(this).stop().removeClass('mv06');
        }
    });
});
//----------------------------------------------------------------------------
// 移動＋フェードイン ： 要素が表示されるエリアまでスクロールしたら、移動＋フェードイン表示しながら要素を表示
//----------------------------------------------------------------------------
$(function() {
    $('.list-mv07').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
        if(isInView){
            $(this).stop().addClass('mv07');
        }
        else{
            $(this).stop().removeClass('mv07');
        }
    });
});
