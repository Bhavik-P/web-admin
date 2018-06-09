!function ($) {
  "use strict";

  var TodoApp = function () {
    this.$body = $("body"),
      this.$todoRemaining = $("#todo-remaining"),
      this.$todoTotal = $("#todo-total"),
      this.$archiveBtn = $("#btn-archive"),
      this.$todoList = $("#todo-list"),
      this.$todoDonechk = ".todo-done",
      this.$todoInput = $("#todo-input-text"),
      this.$todoBtn = $("#todo-btn-submit"),

      this.$todoData = [
        {
          'id': '1',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': false
        },
        {
          'id': '2',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': true
        },
        {
          'id': '3',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': true
        },
        {
          'id': '4',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': true
        },
        {
          'id': '5',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': false
        },
        {
          'id': '6',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': false
        },
        {
          'id': '7',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': true
        },
        {
          'id': '8',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': false
        },
        {
          'id': '9',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': true
        },
        {
          'id': '10',
          'text': 'Lorem ipsum dolor sit amet, consectetuer dolore dolor sit amet.',
          'done': true
        }];
    this.$todoCompletedData = [];
    this.$todoUnCompletedData = [];
  };

  TodoApp.prototype.markTodo = function (todoId, complete) {
    for (var count = 0; count < this.$todoData.length; count++) {
      if (this.$todoData[count].id == todoId) {
        this.$todoData[count].done = complete;
      }
    }
  },
    TodoApp.prototype.addTodo = function (todoText) {
      this.$todoData.push({'id': this.$todoData.length, 'text': todoText, 'done': false});
      this.generate();
    },
    TodoApp.prototype.archives = function () {
      this.$todoUnCompletedData = [];
      for (var count = 0; count < this.$todoData.length; count++) {
        var todoItem = this.$todoData[count];
        if (todoItem.done == true) {
          this.$todoCompletedData.push(todoItem);
        } else {
          this.$todoUnCompletedData.push(todoItem);
        }
      }
      this.$todoData = [];
      this.$todoData = [].concat(this.$todoUnCompletedData);
      this.generate();
    },
    TodoApp.prototype.generate = function () {
      this.$todoList.html("");
      var remaining = 0;
      for (var count = 0; count < this.$todoData.length; count++) {
        var todoItem = this.$todoData[count];
        if (todoItem.done == true)
          this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-primary"><input class="todo-done" id="' + todoItem.id + '" type="checkbox" checked><label for="' + todoItem.id + '">' + todoItem.text + '</label></div></li>');
        else {
          remaining = remaining + 1;
          this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-primary"><input class="todo-done" id="' + todoItem.id + '" type="checkbox"><label for="' + todoItem.id + '">' + todoItem.text + '</label></div></li>');
        }
      }
      this.$todoTotal.text(this.$todoData.length);
      this.$todoRemaining.text(remaining);
    },
    TodoApp.prototype.init = function () {
      var $this = this;
      this.generate();
      this.$archiveBtn.on("click", function (e) {
        e.preventDefault();
        $this.archives();
        return false;
      });

      $(document).on("change", this.$todoDonechk, function () {
        if (this.checked)
          $this.markTodo($(this).attr('id'), true);
        else
          $this.markTodo($(this).attr('id'), false);
        $this.generate();
      });
      this.$todoBtn.on("click", function () {
        if ($this.$todoInput.val() == "" || typeof($this.$todoInput.val()) == 'undefined' || $this.$todoInput.val() == null) {
          sweetAlert("Oops...", "You forgot to enter todo text", "error");
          $this.$todoInput.focus();
        } else {
          $this.addTodo($this.$todoInput.val());
        }
      });
    },
    $.TodoApp = new TodoApp, $.TodoApp.Constructor = TodoApp

}(window.jQuery),

  function ($) {
    "use strict";
    $.TodoApp.init()
  }(window.jQuery);