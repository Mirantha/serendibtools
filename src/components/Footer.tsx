import React from 'react';
import { Phone, Mail, MapPin, Clock, ArrowUpRight } from 'lucide-react';
import {
  COMPANY_INFO,
  PRODUCT_CATEGORIES,
  type PageRoute,
  type ProductCategory,
} from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import { SocialIcons } from './SocialIcons';

interface FooterProps {
  onNavigate: (page: PageRoute, category?: ProductCategory) => void;
}

export const Footer: React.FC<FooterProps> = ({ onNavigate }) => {
  return (
    <footer className="bg-[#131D54] text-slate-200 border-t-4 border-[#F2B705] pb-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 py-14">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
          {/* Brand Column */}
          <div className="lg:col-span-4 space-y-5">
            <button
              type="button"
              onClick={() => onNavigate('home')}
              className="inline-block rounded-lg overflow-hidden bg-[#1E2C7A] p-2.5 border border-white/10 cursor-pointer"
              aria-label="Serendib Tools Home"
            >
              <img
                src={MEDIA_ASSETS.logo}
                alt="Serendib — Believe in Quality"
                referrerPolicy="no-referrer"
                className="h-12 w-auto object-contain"
              />
            </button>
            <p className="text-sm text-slate-300 leading-relaxed max-w-sm">
              {COMPANY_INFO.name} supplies world-leading woodworking machinery,
              precision cutting tools, and sawmills across Sri Lanka with
              certified installation and after-sales support.
            </p>
            <div className="pt-1">
              <p className="text-xs font-semibold tracking-wider text-[#F2B705] uppercase mb-2.5">
                Connect With Us
              </p>
              <SocialIcons variant="light" size="md" />
            </div>
          </div>

          {/* Quick Navigation */}
          <div className="lg:col-span-2">
            <h3 className="text-sm font-semibold text-white mb-4">Navigation</h3>
            <ul className="space-y-2.5 text-sm">
              {(
                [
                  { id: 'home', label: 'Home' },
                  { id: 'about', label: 'About Us' },
                  { id: 'products', label: 'Products Catalog' },
                  { id: 'services', label: 'Our Services' },
                  { id: 'contact', label: 'Contact & Map' },
                ] as { id: PageRoute; label: string }[]
              ).map((item) => (
                <li key={item.id}>
                  <button
                    type="button"
                    onClick={() => onNavigate(item.id)}
                    className="text-slate-300 hover:text-[#F2B705] transition-colors cursor-pointer text-left"
                  >
                    {item.label}
                  </button>
                </li>
              ))}
            </ul>
          </div>

          {/* Machinery Categories */}
          <div className="lg:col-span-3">
            <h3 className="text-sm font-semibold text-white mb-4">
              Machinery &amp; Tooling
            </h3>
            <ul className="space-y-2 text-sm">
              {PRODUCT_CATEGORIES.slice(0, 6).map((cat) => (
                <li key={cat}>
                  <button
                    type="button"
                    onClick={() => onNavigate('products', cat)}
                    className="text-slate-300 hover:text-[#F2B705] transition-colors cursor-pointer text-left"
                  >
                    {cat}
                  </button>
                </li>
              ))}
            </ul>
          </div>

          {/* Showroom & Contact */}
          <div className="lg:col-span-3 space-y-3.5 text-sm">
            <h3 className="text-sm font-semibold text-white mb-4">
              Kesbawa Showroom
            </h3>
            <div className="flex items-start gap-2.5 text-slate-300">
              <MapPin
                className="w-4 h-4 text-[#F2B705] shrink-0 mt-0.5"
                aria-hidden="true"
              />
              <span>{COMPANY_INFO.address}</span>
            </div>
            <div className="flex items-center gap-2.5">
              <Phone
                className="w-4 h-4 text-[#F2B705] shrink-0"
                aria-hidden="true"
              />
              <a
                href={COMPANY_INFO.phoneHref}
                className="text-slate-200 hover:text-[#F2B705] tabular-nums transition-colors"
              >
                {COMPANY_INFO.phoneDisplay}
              </a>
            </div>
            <div className="flex items-center gap-2.5">
              <Mail
                className="w-4 h-4 text-[#F2B705] shrink-0"
                aria-hidden="true"
              />
              <a
                href={`mailto:${COMPANY_INFO.email}`}
                className="text-slate-200 hover:text-[#F2B705] transition-colors"
              >
                {COMPANY_INFO.email}
              </a>
            </div>
            <div className="flex items-start gap-2.5 text-slate-300">
              <Clock
                className="w-4 h-4 text-[#F2B705] shrink-0 mt-0.5"
                aria-hidden="true"
              />
              <span className="text-xs leading-relaxed">{COMPANY_INFO.hours}</span>
            </div>
            <div className="pt-2">
              <a
                href={`https://wa.me/${COMPANY_INFO.whatsappNumber}`}
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center gap-1.5 text-xs font-semibold text-[#F2B705] hover:underline"
              >
                <span>Chat on WhatsApp</span>
                <ArrowUpRight className="w-3.5 h-3.5" aria-hidden="true" />
              </a>
            </div>
          </div>
        </div>
      </div>

      {/* Bottom Legal Bar */}
      <div className="border-t border-white/10 bg-[#0E1642]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400">
          <p>
            &copy; {new Date().getFullYear()} {COMPANY_INFO.name}. All rights reserved. <span className="hidden sm:inline">||</span> <span className="block sm:inline mt-1 sm:mt-0">Developed by <a href="https://creativeidea.lk" target="_blank" rel="noopener noreferrer" className="text-white hover:text-[#F2B705] transition-colors">CreativeIDEA</a></span>
          </p>
          <p>Precision Woodworking Machinery · Sawmills · Industrial Tooling</p>
        </div>
      </div>
    </footer>
  );
};
