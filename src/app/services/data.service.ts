import { Injectable } from '@angular/core';
import { AngularFireDatabase } from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';

@Injectable({
  providedIn: 'root',
})
export class DataService {
  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore
  ) {}

  getCategories() {
    return this.afDatabase.list('/').valueChanges();
  }

  getCharacteristics(product) {
    // return this.afDatabase.list('/').valueChanges();
    return this.afDatabase.object(product).valueChanges();
  }
}
