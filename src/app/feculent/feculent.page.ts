import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-feculent',
  templateUrl: './feculent.page.html',
  styleUrls: ['./feculent.page.scss'],
})
export class FeculentPage implements OnInit {
  public feculentCategoriesName;
  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore,
    private dataService: DataService
  ) {}
  ngOnInit() {
    this.dataService.getCategories().subscribe((response: any) => {
      this.feculentCategoriesName = Object.keys(response.feculents);
      console.log('Liste des feculent', Object.keys(response.feculents));
    });
  }
}
