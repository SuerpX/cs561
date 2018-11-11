import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NewRequestInviteComponent } from './new-request-invite.component';

describe('NewRequestInviteComponent', () => {
  let component: NewRequestInviteComponent;
  let fixture: ComponentFixture<NewRequestInviteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NewRequestInviteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NewRequestInviteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
