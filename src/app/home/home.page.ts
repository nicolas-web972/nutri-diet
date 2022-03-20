import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {
  public categoriesName;
  numbers = ['1','2','3','4'];

  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore,
    private dataService: DataService
  ) {}
  ngOnInit() {
    this.dataService.getCategories().subscribe((response: any) => {
      this.categoriesName = Object.keys(response);
      console.log('BDD', Object.keys(response[0].laitages));
    });
  }
}
