// Filename: views/weights/list
define([
  'jquery',
  'underscore',
  'backbone',
  'text!templates/weights/weights.html',
  'models/weight',
  'common'
], function($, _, Backbone, weightsTemplate, Weight, Common){
  'use strict';

  console.log('weights list view ran...');

  var WeightView = Backbone.View.extend({

    tagName: 'li',

    model: Weight,

    template: _.template( weightsTemplate ),

    events: {
      'click .destroy': 'clear'
    },

    initialize: function () {
      this.listenTo(this.model, 'change', this.render);
      this.listenTo(this.model, 'destroy', this.remove);
      this.render();
    },

    render: function() {
      console.log('weight view render ran...');
      
      this.$el.html(this.template(this.model.toJSON()));
      return this;
    },

    clear: function () {
      this.model.destroy();
    }

  });

  // Returning instantiated views can be quite useful for having "state"
  return WeightView;
});