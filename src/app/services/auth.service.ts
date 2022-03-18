import { Injectable } from '@angular/core';
import {
  Auth,
  signInWithEmailAndPassword,
  createUserWithEmailAndPassword,
  signOut,
  sendPasswordResetEmail
} from '@angular/fire/auth';
import { async } from '@firebase/util';
import { AlertController } from '@ionic/angular';
import { Alert } from 'selenium-webdriver';
@Injectable({
  providedIn: 'root',
})
export class AuthService {
  constructor(private auth: Auth, private alertCtrl: AlertController) {}

  async register({ email, password }) {
    try {
      const userRegis = await createUserWithEmailAndPassword(
        this.auth,
        email,
        password
      );
      return userRegis;
    } catch (e) {
      console.log('error->',e);
      return null;
    }
  }
  async login({ email, password }) {
    try {
      const user = await signInWithEmailAndPassword(this.auth, email, password);
      return user;
    } catch (e) {
      return null;
    }
  }
  logout() {
    return signOut(this.auth);
  }

  async presentAlert() {
    const alert = await this.alertCtrl.create({
      header: 'Réinitialisation de mot de passe',
      message: 'Un e-mail vous a été envoyé !',
      buttons: ['OK']
    });
    alert.present();
  }

   // Recover password
  async sendPasswordReset(email) {
    try {
      await sendPasswordResetEmail(this.auth, email);
      this.presentAlert();
    } catch (err) {
      console.error(err);
    }
  }
};

