<h3 class="mb-4 text-center">{$header ? $header : ''}</h3>
<form action="{$action}" method="post">
	<div class="form-group mb-3">
	  <label for="lname">Фамилия:</label>
	  <input type="text" class="form-control" id="lname" name="lname" value="{$object.lname ? $object.lname : ''}" autofocus>
	</div>

	<div class="form-group mb-3">
	  <label for="fname">Имя:</label>
	  <input type="text" class="form-control" id="fname" name="fname" value="{$object.fname ? $object.fname : ''}">
	</div>

	<div class="form-group mb-3">
	  <label for="mname">Отчество:</label>
	  <input type="text" class="form-control" id="mname" name="mname" value="{$object.mname ? $object.mname : ''}">
	</div>

	<div class="form-group mb-3">
	  <label for="object_name">Название:</label>
	  <input type="text" class="form-control" id="object_name" name="object_name" value="{$object.object_name ? $object.object_name : ''}">
	</div>

	<div class="form-group mb-3">
	  <label for="address">Адрес:</label>
	  <input type="text" class="form-control" id="address" name="address" value="{$object.address ? $object.address : ''}">
	</div>

	<div class="form-group mb-3">
	  <label for="coordinates">Координаты:</label>
	  <input type="text" class="form-control" id="coordinates" placeholder="57.041892,-59.650547" name="coordinates" value="{$object.coordinates ? $object.coordinates : ''}">
	  <small id="coordinates" class="form-text text-muted">В формате: "широта,долгота"</small>
	</div>

	<div class="form-group mb-4">
	  <label for="points">Контурные точки:</label>
	  <input type="text" class="form-control" id="points" placeholder="27.27;46.76" name="points" value="{$object.points ? $object.points : ''}">
	</div>

	<input type="text" hidden="hidden" name="object_id" value="{$object.objects_id ? $object.objects_id : ''}">

	<button type="submit" class="btn btn-block btn-primary">{$button_text}</button>
</form>