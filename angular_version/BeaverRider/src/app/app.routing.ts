import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home';
import { LoginComponent } from './login';
import { RegisterComponent } from './register';
import { AuthGuard } from './_guards';
import { OsuloginComponent } from './osulogin';
import { ProfileComponent } from "./profile";
import { PostDetailComponent } from "./post-detail";
import { NewPostComponent } from "./new-post";
import { UpdatePostComponent } from "./update-post";
import { NewRequestComponent } from "./new-request";
import { UpdateRequestComponent } from "./update-request";
import { UserCenterComponent } from "./user-center";
import { RequestDetailComponent } from "./request-detail";
import { UserPublicProfileComponent } from "./user-public-profile";
import { PostListInviteComponent } from "./post-list-invite";

const appRoutes: Routes = [
    { path: '', component: HomeComponent, canActivate: [AuthGuard] },
    { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'osulogin', component: OsuloginComponent },
    { path: 'profile', component: ProfileComponent, canActivate: [AuthGuard] },
    { path: 'postdetail/:orderid', component: PostDetailComponent },
    { path: 'newpost', component: NewPostComponent },
    { path: 'updatepost/:orderid', component: UpdatePostComponent },
    { path: 'newrequest', component: NewRequestComponent },
    { path: 'updaterequest/:orderid', component: UpdateRequestComponent },
    { path: 'usercenter', component: UserCenterComponent },
    { path: 'requestdetail/:orderid', component: RequestDetailComponent },
    { path: 'userpubilcprofile/:userid', component: UserPublicProfileComponent },
    { path: 'postlistinvite/:requestid', component: PostListInviteComponent },

    // otherwise redirect to home
    { path: '**', redirectTo: '' }
];

export const routing = RouterModule.forRoot(appRoutes);