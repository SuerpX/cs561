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

const appRoutes: Routes = [
    { path: '', component: HomeComponent, canActivate: [AuthGuard] },
    { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'osulogin', component: OsuloginComponent },
    { path: 'profile', component: ProfileComponent, canActivate: [AuthGuard] },
    { path: 'postdetail/:orderid', component: PostDetailComponent },
    { path: 'newpost', component: NewPostComponent },
    { path: 'updatepost/:orderid', component: UpdatePostComponent },

    // otherwise redirect to home
    { path: '**', redirectTo: '' }
];

export const routing = RouterModule.forRoot(appRoutes);