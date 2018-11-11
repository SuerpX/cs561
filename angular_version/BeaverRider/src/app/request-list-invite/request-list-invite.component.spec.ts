import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RequestListInviteComponent } from './request-list-invite.component';

describe('RequestListInviteComponent', () => {
  let component: RequestListInviteComponent;
  let fixture: ComponentFixture<RequestListInviteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RequestListInviteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RequestListInviteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
