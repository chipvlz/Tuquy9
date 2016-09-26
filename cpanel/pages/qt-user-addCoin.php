  <div class="contentTop">
   <span class="pageTitle"><span class="icon-screen"></span>Cộng / trừ / cho vay / trả nợ tiền Game</span>
  </div>

  <!-- Breadcrumbs line -->
  <div class="breadLine">
   <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="#">Dashboard</a></li>
     <li><a href="#">Quản trị người dùng</a></li>
     <li class="current"><a href="#" title="">Cộng/Trừ/Vay/Trả tiền Game</a></li>
    </ul>
   </div>
  </div>

  <!-- Main content -->
  <div class="wrapper">

   <div class="fluid">
    <form id="validate" class="main" method="post" action="/getservice/addcoin">
     <fieldset>
      <div class="widget">
       <div class="whead"><h6>Cộng/Trừ/Vay/Trả tiền Game</h6><div class="clear"></div></div>
       <div class="formRow">
        <div class="grid3"><label>Người chơi(UserName):<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" class="validate[required]" name="username" id="req2"/></div><div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Loại tiền:<span class="req">*</span></label></div>
        <div class="grid9">
         <select name="typemoney" id="selectReq" class="validate[required]" >
          <option value="virtualmoney">Tiền XU</option>
          <option value="realmoney">Tiền GEM</option>
         </select>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Số tiền:<span class="req">*</span></label></div>
        <div class="grid4"><input type="text" value="" class="validate[required,custom[onlyNumberSp]]" name="numsValid" id="numsValid"/></div><div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Hành động:<span class="req">*</span></label></div>
        <div class="grid9">
         <input type="radio" id="radio1" name="actiontype" value="1" checked="checked"/><label for="radio1"  class="mr20">Cộng tiền</label>
         <input type="radio" id="radio2" name="actiontype" value="2" /><label for="radio2"  class="mr20">Trừ tiền</label>
         <input type="radio" id="radio3" name="actiontype" value="3" /><label for="radio3"  class="mr20">Cho vay</label>
         <input type="radio" id="radio4" name="actiontype" value="4" /><label for="radio4"  class="mr20">Trả nợ</label>
        </div>
        <div class="clear"></div>
       </div>
       <div class="formRow">
        <div class="grid3"><label>Lý do:<span class="req">*</span></label></div>
        <div class="grid9"><textarea rows="8" cols="" name="note" class="validate[required]" id="textareaValid"></textarea></div><div class="clear"></div>
       </div>
       <div class="formRow">
        <input type="button" value="Thực hiện" class="buttonM bBlack formSubmit" onclick="addCoin($('#validate'))" />
        <input type="hidden" name="addmoney" />
        <div class="clear"></div>
        </div>
       <div class="clear"></div>
      </div>
     </fieldset>
    </form>
   </div>

  </div>
  <!-- Main content ends -->

