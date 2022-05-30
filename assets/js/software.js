$(".drop-btn").click(function(){
    var id = $(this).attr("rel");
    $("#dropdown"+id).slideToggle();
})


$('.cube-switch .switch').click(function() {
    if ($('.cube-switch').hasClass('active')) {
        $('.cube-switch').removeClass('active');
          $('#usercurrentstatus').removeClass();
        $('#usercurrentstatus').addClass('userisoffline');
        $('#usercurrentstatus').text('Offline');
   var action = 'timeout';
    } else {
        $('.cube-switch').addClass('active');
        $('#usercurrentstatus').removeClass();
        $('#usercurrentstatus').addClass('userisonline');
        $('#usercurrentstatus').text('Online');
  var action = 'timein';
    }


    $.ajax({
        type: "POST",
        url: 'include/ajax/toggle-timein.php',
        data: {
            action: action
        },
        success: function(data) {
            location.reload();

        }
    });

});
$(document).ready( function(){
$('[data-toggle="tooltip"]').tooltip();   


$('#thesearchbox').keyup( function(){
var thiskeyword = $(this).val();


$.ajax({
    type: "POST",
    url: 'include/ajax/searchresult.php',
    data: {
        thiskeyword: thiskeyword
    },
    success: function(data) {
 
        console.log(data);
    }
});

});

       tinymce.init({
            selector:'#editor',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 200,           
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });

});


