<!--{template 'index','header',SITE_TEMP }-->
<!--header end-->
<!--banner-->
<div class="banner_about">
</div>
<!--banner end-->
<!--云系统-->
 
 
         <div class="subpage">
            <div class="content">
                <h2 class="content_title"><b>积分商城</b></h2>
                <div class="content_body">
                   <!--详情-->
                   <!--详情上部产品图片和右边描述-->
                   <div class="mall_xq_top">
                       <div class="mall_xq_top_lt">
                           <table width="100%" border="0" cellpadding="0" cellspacing="0">
                               <tr>
                                   <td><img src="/<!--{$points_info['points_image']}-->"  /></td>
                               </tr>
                           </table>
                       </div>
                       <div class="mall_xq_top_rt">
                           <h4><!--{$points_info['name']}--></h4>
                           <font>市场参考价格：<!--{$points_info['market_price']}-->元</font>
                           <span>所需积分<strong><!--{$points_info['points']}--></strong>分</span>
                           <a href="javascript:void(0);alert('请先登录')" id="order"></a>
                       </div>
                   </div>
                   <!--产品具体详情介绍-->
                   <div class="mall_xq_body">
                       <h4>商品介绍</h4>
                   </div>
                    <div><!--{$points_info['content']}--></div>

                      <div id="ok" class="mall_sh" style="display:none">
                    
                

                  <table width="100%" class="mall_sh_tab" cellpadding="0" cellspacing="0">
                      <tr>
                          <th colspan="2">收货信息</th>
                      </tr>
                      <tr>
                          <td width="12%"><span>姓名：</span></td>
                          <td width="85%"><input name="txtUserName" type="text" id="txtUserName" class="mall_sh_name" />
                              <input type="hidden" name="proid" id="proid" value="1" />
                              <input type="hidden" name="jf" id="jf" value="9999" />
                          </td>
                      </tr>
                      <tr>
                          <td width="12%"><span>电话：</span></td>
                          <td width="85%"><input name="txtTel" type="text" id="txtTel" class="mall_sh_name" /></td>
                      </tr>
                      <tr>
                          <td width="12%"><span>地址：</span></td>
                          <td width="85%"><input name="txtAdd" type="text" id="txtAdd" class="mall_sh_add" /></td>
                      </tr>
                      <tr>
                          <td width="12%"><span>备注：</span></td>
                          <td width="85%"><textarea name="txtNotes" id="txtNotes" rows="5"></textarea></td>
                      </tr>

                        <tr>
                          <td width="12%"> </td>
                          <td width="85%">   <input type="submit" name="Button1" value="确认兑换" id="Button1" class="mall_sh_sure" />  <input type="button" value="取消" onclick="window.location.href='MallDetail.aspx?id=1';" class="mall_sh_sure" style="background:#808080;" /></td>
                      </tr>
                  </table>


               
      
               </div>
                    
                   <!--详情结束-->
                </div>
                  

            </div>
        </div>

    




    <!--云系统结束-->
<!--footer-->
   
<!--{template 'index','footer',SITE_TEMP }-->