import { Component, OnInit } from '@angular/core';

import { Router, RouterEvent } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.page.html',
  styleUrls: ['./sidenav.page.scss'],
})

export class SidenavPage implements OnInit {

  active = '';

  navs = [
    {
      name: 'Catégories',
      link: '/nav/home',
      icon: 'albums'
    },
    {
      name: 'Profil',
      link: '/nav/profile',
      icon: 'person-circle'
    },
  ];

  constructor(private router: Router, private authService: AuthService,) {
    this.router.events.subscribe((event: RouterEvent) => {
      this.active = event.url;
    });
  }

  ngOnInit() { }
  async logout() {
    await this.authService.logout();
    this.router.navigateByUrl('/', { replaceUrl: true });
  }

}
