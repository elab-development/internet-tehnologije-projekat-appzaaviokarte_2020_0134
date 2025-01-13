import { Component, OnInit, Renderer2 } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrl: './home.component.scss',
})
export class HomeComponent {
  constructor(private renderer: Renderer2) {}

  ngOnInit(): void {
    const script = this.renderer.createElement('script');
    script.src = 'assets/js/script.js';
    script.type = 'text/javascript';
    script.async = true;
    this.renderer.appendChild(document.body, script);
  }

  scrollTo(sectionId: string) {
    const section = document.getElementById(sectionId);
    if (section) {
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }
}
