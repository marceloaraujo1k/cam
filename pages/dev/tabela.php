<script src="//code.jquery.com/jquery.min.js"></script> 
<script src="jquery.tabledit.js"></script>

<table class="table" id="example6">
  <thead>
    <tr>
      <th>id</th>
      <th>username</th>
      <th>email</th>
      <th>avatar</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <th>1</th>
      <td>John</td>
      <td>Doe</td>
      <td><select name="avatar" id="avatar" style="display: none;"></select></td>
    </tr>
    <tr>
    <th>2</th>
      <td>Mary</td>
      <td>Moe</td>
      <td></td>
      </tr>
    <tr>
      <th>3</th>
      <td>July</td>
      <td>Dooley</td>
      <td></td>
     </tr>
  </tbody>
</table>

<script>
$('#example6').Tabledit({
    url: 'example.php',
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'username'], [2, 'email'], [3, 'avatar', '{"1": "Black Widow", "2": "Captain America", "3": "Iron Man"}']]
    },
    onDraw: function() {
        console.log('onDraw()');
    },
    onSuccess: function(data, textStatus, jqXHR) {
        console.log('onSuccess(data, textStatus, jqXHR)');
        console.log(data);
        console.log(textStatus);
        console.log(jqXHR);
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        console.log('onFail(jqXHR, textStatus, errorThrown)');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    },
    onAlways: function() {
        console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
        console.log('onAjax(action, serialize)');
        console.log(action);
        console.log(serialize);
    }
});
</script>
