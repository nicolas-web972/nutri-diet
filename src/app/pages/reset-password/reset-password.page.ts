import { Component, OnInit } from '@angular/core';
import { FormGroup } from '@angular/forms';
import { AuthService } from 'src/app/services/auth.service';


@Component({
  selector: 'app-reset-password',
  templateUrl: './reset-password.page.html',
  styleUrls: ['./reset-password.page.scss'],
})
export class ResetPasswordPage implements OnInit {
  email: string ;
  credentials: FormGroup;

  constructor(private auth: AuthService) { }

  ngOnInit(): void {
  }

  forgotPassword() {
    this.auth.sendPasswordReset(this.email);
    this.email = '';
  }
}
