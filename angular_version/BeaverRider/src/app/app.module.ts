import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule }    from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { AppComponent } from './app.component';
import { routing } from './app.routing';
import { AlertComponent } from './_directives';
import { AuthGuard } from './_guards';
import { JwtInterceptor, ErrorInterceptor } from './_helpers';
import { AlertService, AuthenticationService, UserService, PostRequestService } from './_services';
import { HomeComponent } from './home';
import { LoginComponent } from './login';
import { RegisterComponent } from './register';
import { OsuloginComponent } from './osulogin/osulogin.component';
import { ProfileComponent } from './profile/profile.component';
import { PostListComponent } from './post-list/post-list.component';
import { PostDetailComponent } from './post-detail/post-detail.component';
import { NewPostComponent } from './new-post/new-post.component';
import { UpdatePostComponent } from './update-post/update-post.component';
import { UserCenterComponent } from './user-center/user-center.component';
import { DriverActivePostComponent } from './driver-active-post/driver-active-post.component';
import { RequestListComponent } from './request-list/request-list.component';
import { RequestDetailComponent } from './request-detail/request-detail.component';
import { NewRequestComponent } from './new-request/new-request.component';
import { UpdateRequestComponent } from './update-request/update-request.component';
import { UserPublicProfileComponent } from './user-public-profile/user-public-profile.component';
import { PostListInviteComponent } from './post-list-invite/post-list-invite.component';
import { NewPostInviteComponent } from './new-post-invite/new-post-invite.component';
import { RequestListInviteComponent } from './request-list-invite/request-list-invite.component';
import { NewRequestInviteComponent } from './new-request-invite/new-request-invite.component';

@NgModule({
    imports: [
        BrowserModule,
        ReactiveFormsModule,
        HttpClientModule,
        routing
    ],
    declarations: [
        AppComponent,
        AlertComponent,
        HomeComponent,
        LoginComponent,
        RegisterComponent,
        OsuloginComponent,
        ProfileComponent,
        PostListComponent ,
        PostDetailComponent ,
        NewPostComponent ,
        UpdatePostComponent ,
        UserCenterComponent,
        DriverActivePostComponent ,
        RequestListComponent ,
        RequestDetailComponent ,
        NewRequestComponent,
        UpdateRequestComponent,
        UserPublicProfileComponent,
        PostListInviteComponent ,
        NewPostInviteComponent ,
        RequestListInviteComponent ,
        NewRequestInviteComponent
    ],
    providers: [
        AuthGuard,
        AlertService,
        AuthenticationService,
        UserService,
        PostRequestService,
        { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
        { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true }
    ],
    bootstrap: [AppComponent]
})

export class AppModule { }