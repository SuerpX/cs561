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
import { NewPostInviteComponent } from "./new-post-invite";
import { RequestListInviteComponent } from "./request-list-invite";
import { NewRequestInviteComponent } from "./new-request-invite";

const appRoutes: Routes = [
    { path: '', component: HomeComponent },
    { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'osulogin', component: OsuloginComponent },
    { path: 'profile', component: ProfileComponent},
    { path: 'postdetail/:orderid', component: PostDetailComponent, canActivate: [AuthGuard] },
    { path: 'newpost', component: NewPostComponent, canActivate: [AuthGuard] },
    { path: 'updatepost/:orderid', component: UpdatePostComponent, canActivate: [AuthGuard] },
    { path: 'newrequest', component: NewRequestComponent, canActivate: [AuthGuard] },
    { path: 'updaterequest/:orderid', component: UpdateRequestComponent, canActivate: [AuthGuard] },
    { path: 'usercenter', component: UserCenterComponent, canActivate: [AuthGuard] },
    { path: 'requestdetail/:orderid', component: RequestDetailComponent, canActivate: [AuthGuard] },
    { path: 'userpubilcprofile/:userid', component: UserPublicProfileComponent, canActivate: [AuthGuard] },
    { path: 'postlistinvite/:orderid', component: PostListInviteComponent, canActivate: [AuthGuard] },
    { path: 'newpostinvite/:orderid', component: NewPostInviteComponent, canActivate: [AuthGuard] },
    { path: 'requestlistinvite/:orderid', component: RequestListInviteComponent, canActivate: [AuthGuard] },
    { path: 'newrequestinvite/:orderid', component: NewRequestInviteComponent, canActivate: [AuthGuard] },

    { path: '**', redirectTo: '' }
];

export const routing = RouterModule.forRoot(appRoutes);