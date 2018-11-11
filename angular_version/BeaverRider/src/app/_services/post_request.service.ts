import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from '../../environments/environment';
import { User, Post, Request } from '../_models';
import { Observable } from 'rxjs';

@Injectable()
export class PostRequestService {

    constructor(private http: HttpClient) {}

    getPostList(){
        return this.http.get<Post[]>(`${environment.apiUrl}/post_order.php?view=post_order_all`);
    }

    getPostListBycondition(){
        return this.http.get<Post[]>(`${environment.apiUrl}/post_order.php?view=post_order_all`);
    }

    getRequestListBycondition(){
        return this.http.get<Request[]>(`${environment.apiUrl}/request_order.php?view=request_order_all`);
    }

    getPostListByUserId(orderid: string){
        return this.http.get<Post[]>(`${environment.apiUrl}/post_order.php?view=activited_order&userId=` + orderid);
    }

    getRequestListByUserId(orderid: string){
        return this.http.get<Request[]>(`${environment.apiUrl}/request_order.php?view=activited_order&userId=` + orderid);
    }

    getRequestList(){
        return this.http.get<Request[]>(`${environment.apiUrl}/request_order.php?view=request_order_all`);
    }

    getPostDetail(orderid: string){
        return this.http.get<Post>(`${environment.apiUrl}/post_order.php?view=post_info&postId=` + orderid);
    }

    getRequestDetail(orderid: string){
        return this.http.get<Request>(`${environment.apiUrl}/request_order.php?view=request_info&requestId=` + orderid); 
    }

    insertPost(post: Post){
        return this.http.post(`${environment.apiUrl}/post_order.php?view=insert`, post);
    }

    insertRequest(request: Request){
        return this.http.post(`${environment.apiUrl}/request_order.php?view=insert`, request);
    }

    updatePost(post: Post){
        return this.http.post(`${environment.apiUrl}/post_order.php?view=update`, post);
    }

    updateRequest(request: Request){
        return this.http.post(`${environment.apiUrl}/request_order.php?view=update`, request);
    }

    getPostListBylocation(departure: string, destination: string){
        let url = `${environment.apiUrl}/post_order.php?view=location&departure=` + departure + `&destination=` + destination;
        return this.http.get<Post[]>(url);
    }

    getRequestListBylocation(departure: string, destination: string){
        let url = `${environment.apiUrl}/request_order.php?view=location&departure=` + departure + `&destination=` + destination;
        return this.http.get<Request[]>(url);
    }

    deletePost(orderid: string){
        var deleteItem ={
            'postId': orderid
        }
        return this.http.post(`${environment.apiUrl}/post_order.php?view=delete`, deleteItem);
    }

    deleteRequest(orderid: string){
        var deleteItem ={
            'requestId': orderid
        }
        return this.http.post(`${environment.apiUrl}/request_order.php?view=delete`, deleteItem);
    }

    getAllPostByUser(post_userid: string){}

    getComfirmedRequestByUser(post_userid: string){
    }

    getAllRequestByUser(post_userid: string){}

    getWaitlistRequestByUser(post_userid: string){}

    getHistoricalOrderByUser(post_userid: string){}

    confirmconnect(postid: string, requestid: string){
        var connect={
            'postOrderId': postid,
            'requestOrderId': requestid
        }
        return this.http.post(`${environment.apiUrl}/connect_orders.php?view=confirmed`, connect);
    }

    inviterequest(postid: string, requestid: string, postuserid: string){
        var connect={
            'userId': postuserid,
            'postOrderId': postid,
            'requestOrderId': requestid
        }
        console.log(connect);
        
        return this.http.post(`${environment.apiUrl}/connect_orders.php?view=newRequestWaitList`, connect);
    }

    joinpost(postid: string, requestid: string, requestuserid: string){
        var connect={
            'userId': requestuserid,
            'postOrderId': postid,
            'requestOrderId': requestid
        }
        return this.http.post(`${environment.apiUrl}/connect_orders.php?view=newPostWaitList`, connect);
    }

    insertPostfromInvite(post: Post, requestid: string){
		return this.http.post(`${environment.apiUrl}/connect_orders.php?view=newPostAndConnect&requestOrderId=` + requestid, post);
    }
    
    insertRequestfromJoin(request: Request, postid: string){
		return this.http.post(`${environment.apiUrl}/connect_orders.php?view=newRequestAndConnect&postOrderId=` + postid, request);
	}

}