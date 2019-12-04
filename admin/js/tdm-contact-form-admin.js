(function( $ ) {
	'use strict';

	function insertAtCaret(el, text) {
		var caretPos = el.selectionStart;
		var textAreaTxt = el.value;
		el.value = textAreaTxt.substring(0, caretPos) + text + textAreaTxt.substring(caretPos);
	}

	 $( window ).load(function() {
		 $('.insert-text').on('click', function(e){
			 e.preventDefault();
			 var _label = $('#label-text');
			 var _label_str = " label:'" + _label.val() + "' ";

			 var _name = $('#name-text');
			 var _name_str = "name:"+_name.val()+"";
			 _name_str = _name_str.replace(/\s+/g, '-').toLowerCase();

			 var _require = $('#required');
			 var _require_str = '';
			 if(_require.val() == 1){
				 _require_str = " require ";
			 }

			 var _is_email = $('#is-email');
			 var _is_email_str = '';
			 if(_is_email.val() == 1){
				 _is_email_str = " email-format ";
			 }

			 var _class_input = $('#class-text');
			 var _class_str = "";
			 if(_class_input.val() != ''){
				 _class_str = " class:'"+_class_input.val()+"' ";
			 }

			 var _id_input = $('#id-text');
			 var _id_str = "";
			 var _id_val = "";
			 if(_id_input.val() != ''){
				 _id_val = _id_input.val();
				 _id_val = _id_val.replace(/\s+/g, '-').toLowerCase();
				 _id_str = " id:"+_id_val+"";
			 }

			 var _ret_string = "[input:text "+_name_str + _label_str + _require_str + _is_email_str + _class_str + _id_str + "]";

			 var $txt = $('#inputForm');

			 insertAtCaret($txt[0], _ret_string);
			 _label.val('');
			 _name.val('');
			 _require.val(0);
			 _is_email.val(0);
			 _class_input.val('');
			 _id_input.val('');
			 $('#textModal').modal('hide');
		 });

		 $('.insert-textarea').on('click', function(e){
			 e.preventDefault();
			 var _label = $('#label-textarea');
			 var _label_str = " label:'" + _label.val() + "' ";

			 var _name = $('#name-textarea');
			 var _name_str = "name:"+_name.val()+"";
			 _name_str = _name_str.replace(/\s+/g, '-').toLowerCase();

			 var _require = $('#required-textarea');
			 var _require_str = '';
			 if(_require.val() == 1){
				 _require_str = " require ";
			 }

			 var _class_input = $('#class-textarea');
			 var _class_str = "";
			 if(_class_input.val() != ''){
				 _class_str = " class:'"+_class_input.val()+"' ";
			 }

			 var _id_input = $('#id-textarea');
			 var _id_str = "";
			 var _id_val = "";
			 if(_id_input.val() != ''){
				 _id_val = _id_input.val();
				 _id_val = _id_val.replace(/\s+/g, '-').toLowerCase();
				 _id_str = " id:"+_id_val+"";
			 }

			 var _ret_string = "[input:textarea "+_name_str + _label_str + _require_str + _class_str + _id_str + "]";

			 var $txt = $('#inputForm');

			 insertAtCaret($txt[0], _ret_string);

			 _label.val('');
			 _name.val('');
			 _require.val(0);
			 _class_input.val('');
			 _id_input.val('');

			 $('#textAreaModalLabel').modal('hide');
		 });

		 $('.insert-submit').on('click', function(e){
			 e.preventDefault();
			 var _label = $('#label-submit');
			 var _label_str = " label:'" + _label.val() + "' ";

			 var _name = $('#name-submit');
			 var _name_str = "name:"+_name.val()+"";
			 _name_str = _name_str.replace(/\s+/g, '-').toLowerCase();

			 var _class_input = $('#class-submit');
			 var _class_str = "";
			 if(_class_input.val() != ''){
				 _class_str = " class:'"+_class_input.val()+"' ";
			 }

			 var _id_input = $('#id-submit');
			 var _id_str = "";
			 var _id_val = "";
			 if(_id_input.val() != ''){
				 _id_val = _id_input.val();
				 _id_val = _id_val.replace(/\s+/g, '-').toLowerCase();
				 _id_str = " id:"+_id_val+"";
			 }

			 var _ret_string = "[input:submit "+_name_str + _label_str + _class_str + _id_str + "]";

			 var $txt = $('#inputForm');

			 insertAtCaret($txt[0], _ret_string);

			 _label.val('');
			 _name.val('');
			 _class_input.val('');
			 _id_input.val('');

			 $('#submitModal').modal('hide');
		 });

	 });
})( jQuery );
