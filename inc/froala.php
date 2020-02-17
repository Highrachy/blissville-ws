<link href="<?php URL::display('assets/js/froala/css/custom_froala.css') ?>" rel="stylesheet" type="text/css"> <script src="<?php URL::display('assets/js/froala/js/froala_editor.min.js') ?>"></script>
  <!--[if lt IE 9]>
    <script src="<?php URL::display('assets/js/froala/js/froala_editor_ie8.min.js') ?>"></script>
  <![endif]-->
  <script src="<?php URL::display('assets/js/froala/js/plugins/urls.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/lists.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/colors.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/font_family.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/font_size.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/block_styles.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/media_manager.min.js') ?>"></script>
  <script src="<?php URL::display('assets/js/froala/js/plugins/char_counter.min.js') ?>"></script>

  <script>
      $(function(){
        $('.editor').editable({inlineMode: false, height:150});
        $('.editable').editable({countCharacters: false});
        $('.header-editable').editable({countCharacters: false, paragraphy: false, buttons: [], shortcutsAvailable: []});
      });
  </script>

  <style>
    div a[href='http://editor.froala.com'] {
      display: none !important;
      height: 0;
      width: 0;
      position: absolute;
      left:-3000px;
    }

    .froala-box div:not([class]) {
      border: none !important;
    }
  </style>