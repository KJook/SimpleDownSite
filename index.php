
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/rank.css"/>
</head>
<body>
    <h2>KJ简陋的临时下载站</h2>

    <ul>
       <?php
#echo "<body style='background:url(o_cheng.jpg)'; backgroundRepeat:'no-repeat'; backgroundPosition='top center'; >";


function out($path){
    $f=scandir($path);
    foreach($f as $v){
        if($v=='.'||$v=='..') continue;
        if(is_dir($path.$v)){
                $path=$path.$v.'/';
            out($path);
        }else{
            $url = './src/'.$v;//  获取本地文件
            $size = round(filesize($url)/1024,3);
            echo '<li name ='.$size.'><a href="http://180.76.187.91/src/'.$v.'">'.$v.'</a><span>Size：'.$size.'KB</span></li>';
                             
        }
    };
}
out("./src");
?>
    </ul>
    <div>
        <button>从小到大</button><button>从大到小</button><button>取消排序</button><button>文件名从小到大</button><button>文件名从大到小</button>
    </div>

    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <script>
        var color = ['#DAA520' , '#DB7093' , '#cccc33' , '#4682B4' , '#999933' , '#9999cc' , '#663333' , '#6666cc' , '#FF6A6A' , '#009966'];
        var initList = [], domArr = [];
        $('li').each(function(a){

            $(this).css('background' , color[a%8]);
            
            $(this).attr('title' , '原位置为：'+(a+1));
            initList[a] = $(this).html();
        })
        
        function smallToBig(){
            getDom();
            $.each(domArr , function(i){
                $.each(domArr , function(j){
                    if( domArr[i].attr('name') < domArr[j].attr('name')){
                        mid = domArr[j]; domArr[j] = domArr[i]; domArr[i] = mid;
                    }
                })
            })
            appendDom();
        }
        
        /*
        从小到大排序
         */
        function fileSmallToBig(){
            getDom();
            $.each(domArr , function(i){
                $.each(domArr , function(j){
                    if( domArr[i].html() < domArr[j].html()){
                        mid = domArr[j]; domArr[j] = domArr[i]; domArr[i] = mid;
                    }
                })
            })
            appendDom();
        }
        /*
         取消排序
         */
        function cancleRank(){
            getDom();
            $.each(initList,function(b){
                $.each(domArr,function(c){
                    if(domArr[c].html() == initList[b]){
                        $('ul').append(domArr[c]);
                    }
                })
            })
        }
        function bigToSmall(){
            getDom();
            $.each(domArr , function(i){
                $.each(domArr , function(j){
                    if( domArr[i].attr('name') > domArr[j].attr('name')){
                        mid = domArr[j]; domArr[j] = domArr[i]; domArr[i] = mid;
                    }
                })
            })
            appendDom()
        }
        /*
         从大到小排序
         */
        function fileBigToSmall(){
            getDom();
            $.each(domArr , function(i){
                $.each(domArr , function(j){
                    if( domArr[i].html() > domArr[j].html()){
                        mid = domArr[j]; domArr[j] = domArr[i]; domArr[i] = mid;
                    }
                })
            })
            appendDom()
        }
        /*
        取出所有li放进数组
         */
        function getDom(){
            $('li').each(function( m ){
                domArr[m] = $(this);
            })
        }
        /*
        将数组中的li插入ul(原ul中的li自动删除。DOM元素的特性。)
         */
        function appendDom(){
            $.each( domArr, function(d){
                $('ul').append( domArr[d] );
            })
        }
        var funSum = [ smallToBig , bigToSmall , cancleRank, fileSmallToBig, fileBigToSmall];
        $('button').click(function(){
            var fun = funSum[$(this).index()]
            fun();
        })
    </script>
</body>
</html>
