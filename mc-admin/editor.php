<?php function editor($content) { ?>
	<div id="editor">
	<div id="toolbar" class="wmd-toolbar"></div>
	<div class="left">
	<a class="annex">附件</a>
	<a class="wmd-view">预览</a>
	<a class="wmd-type">全屏</a>
	<a class="wmd-off">关闭</a>
    <textarea id="input" name="content" class="wmd-input edit_textarea"><?php echo htmlspecialchars($content); ?></textarea>
	</div>
	<div class="right">
	<div id="preview" class="wmd-preview"></div>
	</div>
	</div>
	
    <script type="text/javascript" src="js/showdown.js"></script>
    <script type="text/javascript" src="js/wmd.js"></script>
    <script>
    $(document).ready(function() {
      new WMD("input", "toolbar", { preview: "preview" });
    });
	
	$(function(){
		$('.annex').click(function(){
		$('body').addClass('annex_body');
		});
		$('.annex_off').click(function(){
		$('body').removeClass('annex_body');
		});
		
		$('.wmd-view').click(function(){
		$('body').addClass('view');
		$('body').removeClass('type');
		});
		$('.wmd-off').click(function(){
		$('body').removeClass('type view');
		});
		
		$('.wmd-type').click(function(){
		$('body').addClass('type');
		$('body').removeClass('view');
		var my_height = document.body.clientHeight-53;
		document.getElementById("input").style.height= my_height + "px";
		document.getElementById("preview").style.height= my_height + "px";
		});
		$('.wmd-off').click(function(){
		$('body').removeClass('type view');
		document.getElementById("input").style.height="";
		document.getElementById("preview").style.height="";
		});
		
		
		});
	
	document.body.clientHeight
	
      function getPageSize() {
          var xScroll, yScroll;
          if (window.innerHeight && window.scrollMaxY) {
              xScroll = window.innerWidth + window.scrollMaxX;
              yScroll = window.innerHeight + window.scrollMaxY;
          } else {
              if (document.body.scrollHeight > document.body.offsetHeight) { // all but Explorer Mac    
                  xScroll = document.body.scrollWidth;
                  yScroll = document.body.scrollHeight;
              } else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari    
                  xScroll = document.body.offsetWidth;
                  yScroll = document.body.offsetHeight;
              }
          }
          var windowWidth, windowHeight;
          if (self.innerHeight) { // all except Explorer    
              if (document.documentElement.clientWidth) {
                  windowWidth = document.documentElement.clientWidth;
              } else {
                  windowWidth = self.innerWidth;
              }
              windowHeight = self.innerHeight;
          } else {
              if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode    
                  windowWidth = document.documentElement.clientWidth;
                  windowHeight = document.documentElement.clientHeight;
              } else {
                  if (document.body) { // other Explorers    
                      windowWidth = document.body.clientWidth;
                      windowHeight = document.body.clientHeight;
                  }
              }
          }       
          // for small pages with total height less then height of the viewport    
          if (yScroll < windowHeight) {
              pageHeight = windowHeight;
          } else {
              pageHeight = yScroll;
          }    
          // for small pages with total width less then width of the viewport    
          if (xScroll < windowWidth) {
              pageWidth = xScroll;
          } else {
              pageWidth = windowWidth;
          }
          arrayPageSize = new Array(pageWidth, pageHeight, windowWidth, windowHeight);
          return arrayPageSize;
      }
/*
      function resizeEditor() {
        var e = document.getElementById('editor');
        e.style.height = (getPageSize()[3] - e.offsetTop - 250) + 'px';
      }
*/
      window.onload = resizeEditor;
      window.onresize = resizeEditor;
    </script>
<?php } ?>
<div class="annex_wind">
<iframe id="iframe" src=""></iframe>
<script>
function setIframeSrc(){
    var s = "upload.php";
    var iframe = document.getElementById("iframe");
    if( -1 == navigator.userAgent.indexOf("MSIE")){
        iframe.src = s;
    }else {
        iframe.location = s;
    }
}
setTimeout(setIframeSrc,100);
</script>
<a class="annex_off">╳</a>
</div>