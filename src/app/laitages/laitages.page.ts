import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-laitages',
  templateUrl: './laitages.page.html',
  styleUrls: ['./laitages.page.scss'],
})
export class LaitagesPage implements OnInit {
  public laitageCategoriesName;
  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore,
    private dataService: DataService
  ) {}
  ngOnInit() {
    this.dataService.getCategories().subscribe((response: any) => {
      this.laitageCategoriesName = Object.keys(response.laitages);
      console.log('Liste des laitage', Object.keys(response.laitages));
    });
  }
}
