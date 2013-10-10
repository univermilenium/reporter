<table width="100%" border="0" cellspacing="0" cellpadding="5" class="users">
  <tr>
    <th scope="col">Usuario</th>
    <th scope="col">Nombre</th>
    <th scope="col">Plantel</th>
    <th scope="col" width="35">&nbsp;</th>
  </tr>
<?php foreach($u->users as $f=>$r): ?>
  <tr>
    <td valign="middle"> <?=$r['user_name']?>&nbsp;</td>
    <td valign="middle"> <?="$r[nombre] $r[apellidos]";?> </td>
    <td valign="middle">&nbsp;<?=$r['plantel']?> </td>
    <td align="center" valign="middle"><img src="app/images/editar.png" onClick="editar(Array('<?=$r['user_id']?>', '<?=$r['user_name']?>', '<?=$r['user_email']?>', '<?=$r['nombre']?>', '<?=$r['apellidos']?>', '<?=$r['tipo']?>', '<?=$r['plantel']?>', '<?=$r['addusers']?>'));"></td>
  </tr>
<?php endforeach; ?>
</table>