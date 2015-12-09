var online = new Array();
var qq = new Array();
qq[0] = new Array();
qq[0][0] = "财来电欢迎您";
qq[0][1] = "543555461";
qq[0][2] = "976152380 ";
qq[0][3] = "364509664";
qq[0][4] = "356483183";
qq[0][5] = "1240827839";
//qq[1] = new Array();
//qq[1][0] = "xxxx";
//qq[1][1] = "000";
var script_src = "http:\/\/webpresence.qq.com\/getonline?Type=1&"
// dynamic generate script src
for (i = 0; i < qq.length; i++) {
    for (j = 1; j < qq[i].length; j++) {
        script_src += qq[i][j];
        script_src += ":";
    }
}
document.write("<script language=\"javascript\" src=\"" + script_src + "\"> <\/script>");
lastScrollY = 0;
function heartBeat()
{
    var diffY;
    var ioc = document.getElementById("full");
    if (ioc == null || ioc == undefined)
        return;
    if (document.documentElement && document.documentElement.scrollTop)
        diffY = document.documentElement.scrollTop;
    else if (document.body)
        diffY = document.body.scrollTop
    else
    {/*Netscape stuff*/
    }
    percent = .1 * (diffY - lastScrollY);
    if (percent > 0) {
        percent = Math.ceil(percent);
    }
    else {
        percent = Math.floor(percent);
    }
    ioc.style.top = ((isNaN(parseInt(ioc.style.top)) ? 0 : parseInt(ioc.style.top)) + percent).toString() + "px";
    lastScrollY = lastScrollY + percent;
}
function mClk() { //自
    event.srcElement.click();
}
var suspendcode;
var contactHandler;
contactHandler = setInterval("checkData()", 2000);
function definedData(varData) {
    if (varData == null && varData == undefined) {
        return false;
    }
    return true;
}
function checkData() {
    if (definedData(online[0])) {
        clearInterval(contactHandler);
        suspendcode = "<div id=\"full\" style='right:3px; top:150px; position:absolute;z-index:1000;text-align:center;'>\n"
                + "<div id='con'>\n"
                + "<div class='list'>\n";
        var onlineP = 0;
        for (i = 0; i < qq.length; i++) {
            suspendcode += " <div class='contact'>\n";
            suspendcode += " <h3>" + qq[i][0] + "</h3>\n";
            for (j = 1; j < qq[i].length; j++) {
                suspendcode += " <a href='tencent://message/?uin=" + qq[i][j] + "&Menu=yes' class='qq'>\n";
                if (i == 0 && j == 1)
                {
                    k = "&nbsp;晓&nbsp;&nbsp;旭";
                }
                if (i == 0 && j == 2)
                {
                    k = "&nbsp;小&nbsp;&nbsp;琪";
                }
                if (i == 0 && j == 3)
                {
                    k = "&nbsp;小&nbsp;&nbsp;丽";
                }
                if (i == 0 && j == 4)
                {
                    k = "&nbsp;小&nbsp;&nbsp;刚";
                }
                if (i == 0 && j == 5)
               {
                  k = "&nbsp;小&nbsp;&nbsp;叶";
               }
//if(i==1 && j==1)
//{
// k = "&nbsp;往&nbsp;&nbsp;事";
//}
                suspendcode += " <img border='0' align='absmiddle' src='/statics/default/images/qqs_1.gif' title='点击QQ与我们交流'/> " + k + "\n";
                suspendcode += " </a>\n";
            }
            suspendcode += " </div>\n";
        }
        suspendcode = suspendcode + "</div>\n"
                + "<a title='关闭' id='toTop' href='javascript:void(0);' onclick='document.getElementById(\"contactContanier\").style.display=\"none\";'><img src='/statics/default/images/con_bom.png' width='128' height='22' style='border:0px' /></a>\n"
                + "</div>\n"
                + "</div>\n";
        document.getElementById("contactContanier").innerHTML = suspendcode;
    }
}
document.write("<div id=\"contactContanier\"><div id=\"toTop\"></div></div>");
window.setInterval("heartBeat()", 1);