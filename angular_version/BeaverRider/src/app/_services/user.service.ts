import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from '../../environments/environment';
import { User } from '../_models';
import { Observable } from 'rxjs';

@Injectable()
export class UserService {
    constructor(private http: HttpClient) { }

    getAll() {
        return this.http.get<User[]>(`${environment.apiUrl}/users`);
    }

    getById(userId: string): Observable<User> {
        console.log('url');
        console.log(`${environment.apiUrl}/users/` + userId);
        return this.http.get<User>(`${environment.apiUrl}/users/` + userId);
    }


    register(user: User) {
        return this.http.post(`${environment.apiUrl}/users/register`, user);
    }

    update(user: User) {
        return this.http.post(`${environment.apiUrl}/read.php?view=update`, user);
    }

    delete(userId: string) {
        return this.http.delete(`${environment.apiUrl}/users/` + userId);
    }

    logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('user');
        localStorage.removeItem('currentUser');
        localStorage.clear();
        
    }
}
