import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

@Injectable()
export class AuthGuard implements CanActivate {

    constructor(private router: Router) { }

    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        
        if (localStorage.getItem('currentUserId')) {
            // logged in so return true
            return true;
        }



        //let user = {"userId":"linzhe","firstname":"Zhengxian","lastname":"Lin","phoneNumber":null,"email":"linzhe@oregonstate.edu","address":null,"orderId":null,"finishRegister":"0"};
        //let users = [{"firstName":"1","lastName":"1","username":"1","password":"123456","id":1},{"firstName":"Kun","lastName":"Chen","username":"kun","password":"123456","id":2}];
        //localStorage.setItem('currentUser', JSON.stringify(user));
        //localStorage.setItem('users', JSON.stringify(users));
        //return true;

        // not logged in so redirect to login page with the return url


        //this.router.navigate(['/osulogin'], { queryParams: { returnUrl: state.url }});
        //return true;
        window.location.href="http://web.engr.oregonstate.edu/~hezhi/beaverrider"
        return false;
    }
}