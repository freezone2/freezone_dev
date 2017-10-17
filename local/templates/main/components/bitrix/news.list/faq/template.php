
    <div class="accordion">
      <?foreach($arResult['ITEMS'] as $arItem){?>
      <div class="accordion-item">
  <p class="accordion-title"><?=$arItem['~NAME'];?></p>
  <div class="accordion-drop">
    <p><?=$arItem['~PREVIEW_TEXT'];?></p>
  </div>
</div><?}?>
    </div>
                
