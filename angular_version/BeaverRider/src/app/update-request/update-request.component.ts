import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { ActivatedRoute } from '@angular/router';
import { AlertService, PostRequestService } from '../_services';
import { Request } from '../_models';

@Component({
  selector: 'app-update-request',
  templateUrl: './update-request.component.html',
  styleUrls: ['./update-request.component.css']
})
export class UpdateRequestComponent implements OnInit {

    requestForm: FormGroup;
    loading = false;
    submitted = false;
    updateRequest: Request;

    constructor(
        private formBuilder: FormBuilder,
        private router: Router,
        private postrequestservice: PostRequestService,
        private alertService: AlertService,
        private route: ActivatedRoute
    ) { }

    ngOnInit() {
		  this.getRequestDetailwithform();
		
    }

    get f() { return this.requestForm.controls; }

    onSubmit() {
		this.submitted = true;

		//let postDate = new Date();
		//this.postForm.value.post_time = postDate.toLocaleString()
		//this.postForm.value.post_userid = localStorage.getItem('currentUserId');
		// stop here if form is invalid
		if (this.requestForm.invalid) {
			console.log(this.requestForm.value);
			
			return;
		}


		this.loading = true;
		this.postrequestservice.updateRequest(this.requestForm.value)
			.pipe(first())
			.subscribe(
				success => {
					this.alertService.success('update request successful', true);
					console.log('update successful');
					this.router.navigate(['']);
					//this.postForm.value.finishRegister = 1;
				},
				error => {
					this.alertService.error(error);
					console.log('update err');
					this.loading = false;
					this.router.navigate(['']);
					//this.postForm.value.finishRegister = 1;
				});
	}
	

	getRequestDetailwithform(){
		let orderid = this.route.snapshot.paramMap.get('orderid');
		//console.log(orderid);
		this.postrequestservice.getRequestDetail(orderid).pipe(first()).subscribe(request => {
			this.updateRequest = request;
			this.requestForm = this.formBuilder.group({
				request_orderid: [this.updateRequest.request_orderid],
				request_userid: [this.updateRequest.request_userid],
				departure_location: [this.updateRequest.departure_location, Validators.required],
				
				destination_location: [this.updateRequest.destination_location, Validators.required],
				departure_city: [this.updateRequest.departure_city, Validators.required],
				departure_state: [this.updateRequest.departure_state, Validators.required],


				departure_time: [this.updateRequest.departure_time, Validators.required],
				destination_city: [this.updateRequest.destination_city, Validators.required],
                destination_state: [this.updateRequest.destination_state, Validators.required],


				request_time: [this.updateRequest.post_time],
				remarks: [this.updateRequest.remarks],
				people_number: [this.updateRequest.people_number, Validators.required],
				available: [this.updateRequest.available],
				finished: [this.updateRequest.finished],
				waitlist: [this.updateRequest.waitlist],
				acceptlist: [this.updateRequest.acceptlist]
			});
			//console.log(this.updateRequest);
		});
	}
}


