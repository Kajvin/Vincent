<div class='box'>
<h4>All modules</h4>
<p>All Vincent modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <li><?=$module['name']?></li>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Vincent core</h4>
<p>Vincent core modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isVincentCore']): ?>
  <li><?=$module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Vincent CMF</h4>
<p>Vincent Content Management Framework (CMF) modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isVincentCMF']): ?>
  <li><?=$module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Models</h4>
<p>A class is considered a model if its name starts with CM.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isModel']): ?>
  <li><?=$module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Controllers</h4>
<p>Implements interface <code>IController</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isController']): ?>
  <li><?=$module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Contains SQL</h4>
<p>Implements interface <code>IHasSQL</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['hasSQL']): ?>
  <li><?=$module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>More modules</h4>
<p>Modules that does not implement any specific Vincent interface.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if(!($module['isController'] || $module['isVincentCore'] || $module['isVincentCMF'])): ?>
  <li><?=$module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>