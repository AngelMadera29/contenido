

<select id="test" name="form_select" onchange="showDiv(this)">
   <option value="0">No</option>
   <option value="1">Yes</option>
</select>
<div id="hidden_div" style="display:none;">Hello hidden content</div>

<script type="text/javascript">
function showDiv(select){
   if(select.value==1){
    document.getElementById('hidden_div').style.display = "block";
   } else{
    document.getElementById('hidden_div').style.display = "none";
   }
} 
</script>














