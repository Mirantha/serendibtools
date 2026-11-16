import React from 'react';
import { ChevronRight } from 'lucide-react';
import type { PageRoute } from '../data/siteData';

interface PageHeaderProps {
  title: string;
  eyebrow: string;
  subtitle: string;
  imageSrc: string;
  imageAlt: string;
  onNavigateHome: () => void;
  currentLabel: string;
  extraAction?: React.ReactNode;
}

export const PageHeader: React.FC<PageHeaderProps> = ({
  title,
  eyebrow,
  subtitle,
  imageSrc,
  imageAlt,
  onNavigateHome,
  currentLabel,
  extraAction,
}) => {
  return (
    <section className="relative overflow-hidden bg-[#131D54] border-b-4 border-[#F2B705]">
      <div className="absolute inset-0">
        <img
          src={imageSrc}
          alt={imageAlt}
          referrerPolicy="no-referrer"
          className="w-full h-full object-cover opacity-40"
        />
        <div
          aria-hidden="true"
          className="absolute inset-0 bg-gradient-to-r from-[#131D54]/95 via-[#1E2C7A]/80 to-[#131D54]/50"
        />
      </div>

      <div className="relative max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
        {/* Breadcrumb */}
        <nav
          aria-label="Breadcrumb"
          className="flex items-center gap-1.5 text-xs font-medium text-slate-300 mb-4"
        >
          <button
            type="button"
            onClick={onNavigateHome}
            className="hover:text-[#F2B705] transition-colors cursor-pointer"
          >
            Home
          </button>
          <ChevronRight className="w-3.5 h-3.5 text-[#F2B705]" aria-hidden="true" />
          <span className="text-white">{currentLabel}</span>
        </nav>

        <div className="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div className="max-w-2xl">
            <p className="text-xs font-semibold tracking-wider uppercase text-[#F2B705] mb-2">
              {eyebrow}
            </p>
            <h1 className="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight text-balance">
              {title}
            </h1>
            <div
              aria-hidden="true"
              className="w-16 h-1 bg-[#F2B705] rounded-full mt-4 mb-4"
            />
            <p className="text-sm sm:text-base text-slate-200 leading-relaxed max-w-xl">
              {subtitle}
            </p>
          </div>
          {extraAction && <div className="shrink-0">{extraAction}</div>}
        </div>
      </div>
    </section>
  );
};
