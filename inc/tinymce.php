<script type="text/javascript" src="<?php get_url('assets/js/tinymce/tinymce.min.js') ?>"></script>
<!-- Initialize the editor. -->
<style> 
/* on mobile browsers, I set a width of 100% */
table.mceLayout, textarea.tinyMCE {
    width: 100% !important;
}

/* on large screens, I use a different layout, so 600px are sufficient */
@media only screen and (min-width: 600px) {
    table.mceLayout, textarea.richEditor {
       width: 600px !important;
    }
}


/* Make the tinymce have same background color as default background*/
.mce-panel {
border: 0px solid #cccccc;
/* Make background lighter*/
background: #fcfcfc; 
}

.mce-btn {
border: 1px solid #cccccc;
box-shadow: none;
background: #f1f1f1;
}

.mce-primary button, .mce-primary button i {
text-shadow: none;
background:#446cb3;
}

.mce-btn:hover{
  background: #ccc;
}
</style>

<?php if (isset($preview) && ($preview)){ 
$preview_text = "Campaign";
if (isset($name)){
  $preview_text = $name;
}

?>
<!-- Initialize the editor. -->
<script type="text/javascript">
  tinymce.init({
      selector: "textarea.preview",
      toolbar: false,
      menubar: false,
      height: 350,
      statusbar: false,
      visual_table_class: "no-border",
      readonly: 1
  });
</script>
<!-- /TinyMCE -->
<?php } else { ?>
<!-- Initialize the editor. -->
<script type="text/javascript">
  tinymce.init({
      selector: "textarea",
      element_format : "html", //Output should be in html not xhtml

      theme: "modern",
    
    // ===========================================
    // INCLUDE THE PLUGIN2
    // ===========================================    
      plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table directionality",
          "paste textcolor colorpicker textpattern image"
      ],




      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================

     //  templates: [ 
     //    {title: 'Some title 1', description: 'Some desc 1', content: 'My content'}, 
     //    {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'} 
     // ],

      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
      toolbar1: "undo redo | sizeselect | fontselect | fontsizeselect | styleselect | linkholder | placeholder",
      toolbar2: "bold italic | forecolor backcolor |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview fullscreen",

      image_advtab: true,

      // ===========================================
      // MAKE UPLOADED IMAGES ABSOLUTE
      // ===========================================
      relative_urls : false,
      remove_script_host : false,
      document_base_url : <?php echo "'".BASE_URL."'" ?>,

    // ===========================================
    // ADD PLACEHOLDERS AND LINK HOLDERS
    // ===========================================
     setup: function(editor) {
          editor.addButton('placeholder', {
              type: 'menubutton',
              text: 'Placeholders',
              icon: false,
              menu: [
                  {text: 'Title', onclick: function() {editor.insertContent('{title}');}},
                  {text: 'First Name', onclick: function() {editor.insertContent('{first_name}');}},
                  {text: 'Last Name', onclick: function() {editor.insertContent('{last_name}');}},
                  {text: 'Company', onclick: function() {editor.insertContent('{company}');}},
                  {text: 'Email', onclick: function() {editor.insertContent('{email}');}}
              ]
          });
          editor.addButton('linkholder', {
              type: 'menubutton',
              text: 'Linkholders',
              icon: false,
              menu: [
                  {text: 'Unsubscribe', onclick: function() {editor.insertContent('<a href="{unsubscribe}">Unsubscribe</a>');}},
                  {text: 'Web Version', onclick: function() {editor.insertContent('<a href="{webversion}">Web version</a>');}},
                  {text: 'Forward', onclick: function() {editor.insertContent('<a href="{webversion}#forward">Forward to friend</a>');}},
                  {text: 'Share on Facebook', onclick: function() {editor.insertContent('<a href="http://www.facebook.com/sharer/sharer.php?u={webversion}">Share on Facebook</a>');}},
                  {text: 'Share on Twitter', onclick: function() {editor.insertContent('<a href="http://twitter.com/home?status=<?php if (!isset($subject)) $subject=""; echo urlencode(trim($subject)) ?>+{webversion}">Share on Twitter</a>');}},
                  {text: 'Share on LinkedIn', onclick: function() {editor.insertContent('<a href="http://www.linkedin.com/shareArticle?mini=true&url={webversion}">Share on LinkedIn</a>');}},
                  {text: 'Share on Google+', onclick: function() {editor.insertContent('<a href="https://plus.google.com/share?url={webversion}">Share on Google+</a>');}}
              ]
          });
      }
    



  });

</script>
<!-- /TinyMCE -->
<?php } ?>