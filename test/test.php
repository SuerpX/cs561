<!DOCTYPE html>
<html>
<body>

<h2>Using the XMLHttpRequest Object</h2>

<div id="demo">
    <button type="button" onclick="loadXMLDoc()">Change Content</button>
</div>

<script type="text/javascript">
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        "userId":"linzhe",
        "firstname":"Zhengxian",
        "lastname":"Lin",
        "phoneNumber":"123456",
        "email":"linzhe@oregonstate.edu",
        "address":"fjdhsklfjklasd",
        "orderId":null,
        "finishRegister":"1"
    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/read.php?view=update");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/post_order.php?view=post_info&postId=1541742824linzhe");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();

    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'post_orderid': '1541472715hezhi',
        'post_userid' : 'line',
        'departure_location': 'portland',
        'destination_location': 'corvallis',
        'departure_time': '2018-11-07 16:34:11',
        'post_time': '2018-11-07 16:34:00',
        'remarks' : 'tst',
        'available_seats': '1',
        'available': '1',
        'finished': 1,
        'departure_city':'convallis',
        'departure_state':'oregon',
        'destination_city':'portland',
        'destination_state':'oregon',
    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/post_order.php?view=update");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'post_userid' : 'linzhe',
        'departure_location': '111 sw 222th st',
        'destination_location': '111 sw 222th st',
        'departure_time': '2018-11-07 16:34:11',
        'post_time': '2018-11-07 16:30:00',
        'remarks' : 'test',
        'available_seats': '4',
        'available': '1',
        'finished': '0',
        'departure_city':'corvallis',
        'departure_state':'oregon',
        'destination_city':'portland',
        'destination_state':'oregon',

    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/post_order.php?view=insert");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/request_order.php?view=request_order_all");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/request_order.php?view=location&departure=portland&destination=corvallis");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/post_order.php?view=activited_order&userId=linzhe");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'postId': '1541316864linzhe'
    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/post_order.php?view=delete");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'request_userid' : 'linzhe',
        'departure_location': 'corvallis',
        'destination_location': 'portland',
        'departure_time': '2018-11-07 16:34:12',
        'post_time': '2018-11-07 16:34:00',
        'remarks' : 'test',
        'people_number': '4',
        'available': '1',
        'finished': '0',
        'departure_city':'convallis',
        'departure_state':'oregon',
        'destination_city':'portland',
        'destination_state':'oregon'
    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/request_order.php?view=insert");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'requestId': '1541554038'
    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/request_order.php?view=delete");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */
    /*
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    var json = {
        'request_orderid': '1541554181linzhe',
        'request_userid' : 'linzhe',
        'departure_location': 'pord',
        'destination_location': 'corvallis',
        'departure_time': '2018-11-02 16:34:11',
        'post_time': '2018-11-07 16:34:00',
        'remarks' : 'tst',
        'people_number': '1',
        'available': '1',
        'finished': 0,
        'departure_city':'convallis',
        'departure_state':'oregon',
        'destination_city':'portland',
        'destination_state':'oregon'
    };
    xhr.open("POST","http://web.engr.oregonstate.edu/~hezhi/api/request_order.php?view=update");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send(JSON.stringify(json));
    */

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/post_order.php?view=match&startState=&endState=&departure=corvallis&destination=");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if( xhr.readyState==4 && xhr.status==200 )
        {
            console.log(xhr.responseText);
        }
    }
    xhr.open("GET","http://web.engr.oregonstate.edu/~hezhi/api/request_order.php?view=match&startState=or&endState=OR&departure=corvallis&destination=portland");
    xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
    xhr.send();

</script>

</body>
</html>
