$().ready(function() {

  // show/hide div during ajax calls
  $('div#ajax').ajaxStart(function() {
    $(this).show();
  }).ajaxComplete(function() {
    $(this).hide();
  });

  // filters
  var ajaxFilter = function(e) {
    var $form = $(this);
    $.ajax({
      type:    'POST',
      url:     $form.attr('action') + '?sf_format=json',
      data:    $form.serializeArray(),
      success: showProducts
    });
    return false;
  };
  var showProducts = function(results) {
    var $ul = $('div#products ul');
    $ul.empty();
    $.each(results, function(i, val) {
      var $li = $('<li>');
      $li.append(val.name).append(' ');
      $li.append($('<span class="cat">').append(val.category)).append(' ');
      $li.append($('<span class="price">').append(val.price)).append(' ');
      var $a = $(val.url).click(ajaxAdd);
      $li.append($a);
      $ul.append($li);
    });
    if ($ul.find('li').length === 0) {  // no product found
      var $li = $('<li class="no">').append('No results');
      $ul.append($li);
    }
  };

  // add to cart
  var ajaxAdd = function(e) {
    $.ajax({
      url:     this.href + '?sf_format=json',
      success: function(r) { cartAdd(r, e.target); }
    });
    return false;
  };
  var cartAdd = function(result, link) {
    if (result.item === false) {
      return;
    }
    var $ul = $('div#cart ul');
    if ($ul.length === 0) {  // no items yet
      $ul = $('<ul>');
      $('div#cart').append($ul);
      $('div#cart').append($('<strong>').append('Total: '));
      $('div#cart').append($('<span id="total">').append(result.total)).append(' ');
      $('div#cart').append($(result.a_empty).click(ajaxEmpty));
    }
    var $li = $('<li id="' + result.p_id + '">');
    var $a_r = $(result.a_remove).click(ajaxRemove);
    var $a_d = $(result.a_decrease).click(ajaxDecrease);
    var $a_i = $(result.a_increase).click(ajaxIncrease);
    $li.append($('<em>').append(result.name)).append(' ');
    $li.append($('<span class="price">').append(result.price)).append(' ');
    $li.append($a_r).append(' ');
    $li.append($a_d).append(' ');
    $li.append($('<span class="quantity">').append(result.quantity)).append(' ');
    $li.append($a_i).append(' ');
    $ul.append($li);
    $('span#total').empty().append(result.total);
  };

  // product removing
  var ajaxRemove = function(e) {
    if (confirm('remove product "' + $(this).prev().prev().text() + '"?')) {
      $.ajax({
        url:     this.href + '?sf_format=json',
        success: function(r) { remove(r, e.target); }
      });
    }
    return false;
  };
  var remove = function(result, a) {
    var $li = $(a).parents('li');
    var $ul = $(a).parents('ul');
    $li.fadeOut('slow', function () { $(this).remove(); });
    if ($ul.find('li').length < 2) {  // product was last one in cart
      $('div#cart strong, span#total, a#empty_cart').fadeOut('slow', function () { $(this).remove(); });
    } else {
      $('span#total').empty();
      $('span#total').append(result.total);
    }
  };

  // product increase
  var ajaxIncrease = function(e) {
    $.ajax({
      url:     this.href + '?sf_format=json',
      success: function(r) { increase(r, e.target); }
    });
    return false;
  };
  var increase = function(result, a) {
    var $li = $(a).parents('li');
    var $span = $li.find('span.quantity');
    var oldq = parseInt($span.text(), 10);
    var newq = oldq + 1;
    $span.empty().append(newq);
    $('span#total').empty();
    $('span#total').append(result.total);
  };

  // product decrease
  var ajaxDecrease = function(e) {
    $.ajax({
      url:     this.href + '?sf_format=json',
      success: function(r) { decrease(r, e.target); }
    });
    return false;
  };
  var decrease = function(result, a) {
    var $li = $(a).parents('li');
    var $span = $li.find('span.quantity');
    var oldq = parseInt($span.text(), 10);
    var newq = oldq - 1;
    if (newq === 0) {  // if decreased to zero, remove
      $li.fadeOut('slow', function () { $(this).remove(); });
    } else {
      $span.empty().append(newq);
    }
    $('span#total').empty().append(result.total);
  };

  // empty cart
  var ajaxEmpty = function(e) {
    if (confirm('empty cart?')) {
      $.ajax({
        url:     this.href + '?sf_format=json',
        success: empty
      });
    }
    return false;
  };
  var empty = function(result) {
    $('div#cart ul, div#cart strong, span#total, a#empty_cart').fadeOut('slow', function () { $(this).remove(); });
  };

  // ---------------------------------------------------- //

  // filter
  $('div#filters form').submit(ajaxFilter);
  // add to cart
  $('div#products a').click(ajaxAdd);
  // remove from cart
  $('div#cart a.remove').click(ajaxRemove);
  // increase cart
  $('div#cart a.increase').click(ajaxIncrease);
  // decrease cart
  $('div#cart a.decrease').click(ajaxDecrease);
  // empty cart
  $('a#empty_cart').click(ajaxEmpty);

});