import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from '../../environments/environment';
import { User, Post } from '../_models';
import { Observable } from 'rxjs';

@Injectable()
export class PostRequestService {

    constructor(private http: HttpClient) {}

    getPostList(){
        return this.http.get<Post[]>(`${environment.apiUrl}/post_order.php?view=post_order_all`);
    }

    getRequestList(){
        return this.http.get<Post[]>(`${environment.apiUrl}/request`);
    }

    getPostDetail(orderid: string){
        return this.http.get<Post>(`${environment.apiUrl}/post_order.php?view=post_info&postId=` + orderid);
    }

    insertPost(post: Post){
        return this.http.post(`${environment.apiUrl}/post_order.php?view=insert`, post);
    }

    updatePost(post: Post){
        return this.http.post(`${environment.apiUrl}/post_order.php?view=update`, post);
    }

    getPostListBylocation(departure: string, destination: string){
        let url = `${environment.apiUrl}/post_order.php?view=location&departure=` + departure + `&destination=` + destination;
        return this.http.get<Post[]>(url);
    }

    deletePost(orderid: string){
        var deleteItem ={
            'postId': orderid
        }
        return this.http.post('${environment.apiUrl}/post_order.php?view=delete', deleteItem);
    }

}