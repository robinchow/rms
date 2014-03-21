// Generated by CoffeeScript 1.7.1
(function() {
  var add_line_breaks, change_current_email, construct_data, construct_item, construct_items, delete_current_email, edit_storage, format_data, initialize, load_current_form, load_data, load_saved_list, new_email, new_item, read_storage, save_current_form;

  new_item = function() {
    var $item_contents;
    $item_contents = $(window.item_template);
    return $('<li>').append($item_contents);
  };

  add_line_breaks = function(string) {
    return string.replace(/\n/g, '<br>');
  };

  construct_item = function($li) {
    return {
      type: $li.find('[name="type"]').val(),
      heading: $li.find('[name="heading"]').val(),
      body: $li.find('[name="body"]').val()
    };
  };

  construct_items = function($ol) {
    var li, _i, _len, _ref, _results;
    _ref = $ol.find('li');
    _results = [];
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      li = _ref[_i];
      _results.push(construct_item($(li)));
    }
    return _results;
  };

  construct_data = function($form) {
    var $header_and_footer;
    $header_and_footer = $form.find('.header_and_footer');
    return {
      heading: $header_and_footer.find('[name="heading"]').val(),
      subheading: $header_and_footer.find('[name="subheading"]').val(),
      greeting: $header_and_footer.find('[name="greeting"]').val(),
      signature: $header_and_footer.find('[name="signature"]').val(),
      items: construct_items($form.find('.items ol'))
    };
  };

  format_data = function(data) {
    var item, _i, _len, _ref;
    data.signature = add_line_breaks(data.signature);
    _ref = data.items;
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      item = _ref[_i];
      item.body = markdown.toHTML(item.body);
    }
    return escape(JSON.stringify(data));
  };

  load_data = function($form, data) {
    var $header_and_footer, $items, $li, item, _i, _len, _ref, _results;
    $header_and_footer = $form.find('.header_and_footer');
    $header_and_footer.find('[name="heading"]').val(data.heading);
    $header_and_footer.find('[name="subheading"]').val(data.subheading);
    $header_and_footer.find('[name="greeting"]').val(data.greeting);
    $header_and_footer.find('[name="signature"]').val(data.signature);
    $items = $form.find('.items ol').empty();
    _ref = data.items;
    _results = [];
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      item = _ref[_i];
      $li = new_item();
      $li.find('[name="type"]').val(item.type);
      $li.find('[name="heading"]').val(item.heading);
      $li.find('[name="body"]').val(item.body);
      _results.push($items.append($li));
    }
    return _results;
  };

  read_storage = function() {
    if (localStorage.data != null) {
      return JSON.parse(localStorage.data);
    } else {
      return {
        current: 0,
        saves: []
      };
    }
  };

  edit_storage = function(func) {
    var data;
    data = read_storage();
    func(data);
    return localStorage.data = JSON.stringify(data);
  };

  load_saved_list = function($saved) {
    var $li, data, i, item, _i, _len, _ref, _results;
    data = read_storage();
    $saved.empty();
    _ref = data.saves;
    _results = [];
    for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
      item = _ref[i];
      $li = $('<li>').text(item.subheading);
      if (data.current === i) {
        $li.addClass('active');
      }
      _results.push($saved.append($li));
    }
    return _results;
  };

  save_current_form = function($form, $saved) {
    edit_storage(function(data) {
      return data.saves[data.current] = construct_data($form);
    });
    return load_saved_list($saved);
  };

  load_current_form = function($form, $saved) {
    var data;
    data = read_storage();
    load_saved_list($saved);
    if (data.saves[data.current] != null) {
      return load_data($form, data.saves[data.current]);
    }
  };

  initialize = function($form, $saved) {
    var data;
    data = read_storage();
    if (data.saves.length === 0) {
      save_current_form($form, $saved);
    }
    return load_current_form($form, $saved);
  };

  new_email = function($form, $saved) {
    save_current_form($form, $saved);
    edit_storage(function(data) {
      var key, new_data, value, _ref;
      new_data = {};
      _ref = data.saves[data.current];
      for (key in _ref) {
        value = _ref[key];
        new_data[key] = value;
      }
      new_data.items = [{}];
      data.saves.push(new_data);
      return data.current = data.saves.length - 1;
    });
    return load_current_form($form, $saved);
  };

  change_current_email = function(index, $form, $saved) {
    save_current_form($form, $saved);
    edit_storage(function(data) {
      return data.current = index;
    });
    return load_current_form($form, $saved);
  };

  delete_current_email = function($form, $saved) {
    edit_storage(function(data) {
      console.log('current', data.current);
      data.saves.splice(data.current, 1);
      return data.current = Math.max(0, Math.min(data.current, data.saves.length - 1));
    });
    return load_current_form($form, $saved);
  };

  $(function() {
    initialize($('form'), $('section.saved ol'));
    $('#generate').click(function(event) {
      var $form, data;
      event.preventDefault();
      $form = $(this).parents('form');
      save_current_form($form, $('section.saved ol'));
      data = construct_data($form);
      return window.open('generate.html?' + format_data(data));
    });
    $('section.items').on('click', 'button.plus', function(event) {
      event.preventDefault();
      return $('section.items ol').append(new_item());
    }).on('click', 'button.minus', function(event) {
      event.preventDefault();
      return $(this).parents('li').first().remove();
    }).on('click', 'button.up', function(event) {
      var $this;
      event.preventDefault();
      $this = $(this).parents('li');
      return $this.insertBefore($this.prev());
    }).on('click', 'button.down', function(event) {
      var $this;
      event.preventDefault();
      $this = $(this).parents('li');
      return $this.insertAfter($this.next());
    });
    return $('section.saved').on('click', 'button.plus', function(event) {
      return new_email($('form'), $('section.saved ol'));
    }).on('click', 'button.minus', function(event) {
      if (!confirm('Are you sure you want to delete this email?')) {
        return;
      }
      return delete_current_email($('form'), $('section.saved ol'));
    }).on('click', 'li', function(event) {
      return change_current_email($(this).index(), $('form'), $(this).parents('ol').first());
    });
  });

}).call(this);
