import React, { useState } from 'react';
import { Phone, Mail, MapPin, Search, Menu, X } from 'lucide-react';
import { COMPANY_INFO, type PageRoute } from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import { SocialIcons } from './SocialIcons';

interface NavbarProps {
  currentPage: PageRoute;
  onNavigate: (page: PageRoute) => void;
  onOpenSearch: () => void;
}

const NAV_LINKS: { id: PageRoute; label: string }[] = [
  { id: 'home', label: 'Home' },
  { id: 'about', label: 'About' },
  { id: 'products', label: 'Products' },
  { id: 'services', label: 'Services' },
  { id: 'contact', label: 'Contact' },
];

export const Navbar: React.FC<NavbarProps> = ({
  currentPage,
  onNavigate,
  onOpenSearch,
}) => {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  const handleLinkClick = (page: PageRoute) => {
    setMobileMenuOpen(false);
    onNavigate(page);
  };

  return (
    <>
      {/* Pre-header Utility Bar (non-sticky so mobile sticky height stays minimal) */}
      <div className="hidden md:block bg-[#131D54] text-slate-200 border-b border-white/10">
        <div className="max-w-7xl mx-auto px-6 h-9 flex items-center justify-between text-xs">
          <div className="flex items-center gap-6">
            <a
              href={COMPANY_INFO.phoneHref}
              className="inline-flex items-center gap-1.5 hover:text-[#F2B705] transition-colors tabular-nums"
            >
              <Phone className="w-3.5 h-3.5 text-[#F2B705]" aria-hidden="true" />
              <span>{COMPANY_INFO.phoneCompact}</span>
            </a>
            <a
              href={`mailto:${COMPANY_INFO.email}`}
              className="inline-flex items-center gap-1.5 hover:text-[#F2B705] transition-colors"
            >
              <Mail className="w-3.5 h-3.5 text-[#F2B705]" aria-hidden="true" />
              <span>{COMPANY_INFO.email}</span>
            </a>
            <button
              type="button"
              onClick={() => handleLinkClick('contact')}
              className="inline-flex items-center gap-1.5 hover:text-[#F2B705] transition-colors cursor-pointer"
            >
              <MapPin className="w-3.5 h-3.5 text-[#F2B705]" aria-hidden="true" />
              <span>Kesbawa, Sri Lanka</span>
            </button>
          </div>
          <SocialIcons variant="light" size="sm" />
        </div>
      </div>

      {/* Main Sticky Header — Clean 3-Zone Contract */}
      <header className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-xs">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-8">
          {/* Zone 1: Attached Brand Logo */}
          <button
            type="button"
            onClick={() => handleLinkClick('home')}
            aria-label="Serendib Tools Home"
            className="flex items-center shrink-0 rounded-md overflow-hidden bg-[#1E2C7A] px-2.5 py-1.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1E2C7A] cursor-pointer"
          >
            <img
              src={MEDIA_ASSETS.logo}
              alt="Serendib — Believe in Quality"
              referrerPolicy="no-referrer"
              className="h-9 sm:h-10 w-auto object-contain"
            />
          </button>

          {/* Zone 2: 5 Single-Line Navigation Links */}
          <nav
            aria-label="Primary Navigation"
            className="hidden md:flex items-center gap-7"
          >
            {NAV_LINKS.map((link) => {
              const isActive = currentPage === link.id;
              return (
                <button
                  key={link.id}
                  type="button"
                  onClick={() => handleLinkClick(link.id)}
                  aria-current={isActive ? 'page' : undefined}
                  className={`relative py-2 text-sm font-semibold whitespace-nowrap shrink-0 transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1E2C7A] rounded ${
                    isActive
                      ? 'text-[#1E2C7A]'
                      : 'text-slate-600 hover:text-[#1E2C7A]'
                  }`}
                >
                  {link.label}
                  {isActive && (
                    <span
                      aria-hidden="true"
                      className="absolute left-0 right-0 bottom-0 h-0.5 bg-[#F2B705] rounded-full"
                    />
                  )}
                </button>
              );
            })}
          </nav>

          {/* Zone 3: Search Trigger + Primary Action */}
          <div className="flex items-center gap-2.5 shrink-0">
            <button
              type="button"
              onClick={onOpenSearch}
              aria-label="Search machinery and tools"
              className="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors whitespace-nowrap shrink-0 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1E2C7A]"
            >
              <Search className="w-4 h-4 text-[#1E2C7A]" aria-hidden="true" />
              <span className="hidden lg:inline">Search</span>
            </button>

            <button
              type="button"
              onClick={() => handleLinkClick('contact')}
              className="hidden sm:inline-flex items-center px-4 py-2 text-sm font-semibold text-[#131D54] bg-[#F2B705] hover:bg-[#D69E00] rounded-lg transition-colors whitespace-nowrap shrink-0 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1E2C7A]"
            >
              Inquire Now
            </button>

            <button
              type="button"
              onClick={() => setMobileMenuOpen((prev) => !prev)}
              aria-expanded={mobileMenuOpen}
              aria-label={mobileMenuOpen ? 'Close menu' : 'Open menu'}
              className="md:hidden inline-flex items-center justify-center p-2.5 text-slate-700 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
            >
              {mobileMenuOpen ? (
                <X className="w-5 h-5" aria-hidden="true" />
              ) : (
                <Menu className="w-5 h-5" aria-hidden="true" />
              )}
            </button>
          </div>
        </div>

        {/* Mobile Drawer */}
        {mobileMenuOpen && (
          <div className="md:hidden border-t border-slate-200 bg-white px-4 py-4 space-y-2 shadow-lg">
            <nav aria-label="Mobile Navigation" className="flex flex-col gap-1">
              {NAV_LINKS.map((link) => {
                const isActive = currentPage === link.id;
                return (
                  <button
                    key={link.id}
                    type="button"
                    onClick={() => handleLinkClick(link.id)}
                    className={`w-full text-left px-3.5 py-2.5 rounded-lg text-sm font-semibold transition-colors ${
                      isActive
                        ? 'bg-[#1E2C7A] text-white'
                        : 'text-slate-700 hover:bg-slate-100'
                    }`}
                  >
                    {link.label}
                  </button>
                );
              })}
            </nav>
            <div className="pt-3 border-t border-slate-100 flex items-center justify-between gap-3">
              <button
                type="button"
                onClick={() => handleLinkClick('contact')}
                className="flex-1 py-2.5 px-4 text-sm font-semibold text-[#131D54] bg-[#F2B705] rounded-lg text-center"
              >
                Inquire Now
              </button>
              <SocialIcons variant="dark" size="sm" />
            </div>
          </div>
        )}
      </header>
    </>
  );
};
