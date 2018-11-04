import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from '../../environments/environment';
import { User, Post } from '../_models';
import { Observable } from 'rxjs';

@Injectable()
export class PostRequestService {
    constructor(private http: HttpClient) { }

    getPostList(){
        return this.http.get<Post[]>(`${environment.apiUrl}/request_order.php?view=request_order_all`);
    }

    getRequestList(){
        return this.http.get<Post[]>(`${environment.apiUrl}/request`);
    }
}