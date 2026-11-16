import React, { useEffect, useState } from 'react';
import { ChevronLeft, ChevronRight, ArrowRight } from 'lucide-react';
import { HERO_SLIDES, type PageRoute, type ProductCategory } from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';

interface HeroSliderProps {
  onNavigate: (page: PageRoute, category?: ProductCategory) => void;
}

export const HeroSlider: React.FC<HeroSliderProps> = ({ onNavigate }) => {
  const [activeIndex, setActiveIndex] = useState(0);
  const [paused, setPaused] = useState(false);

  useEffect(() => {
    if (paused) return;
    const prefersReduced =
      typeof window !== 'undefined' &&
      window.matchMedia?.('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) return;

    const timer = window.setInterval(() => {
      setActiveIndex((prev) => (prev + 1) % HERO_SLIDES.length);
    }, 6000);

    return () => window.clearInterval(timer);
  }, [paused]);

  const goPrev = () => {
    setActiveIndex((prev) => (prev - 1 + HERO_SLIDES.length) % HERO_SLIDES.length);
  };

  const goNext = () => {
    setActiveIndex((prev) => (prev + 1) % HERO_SLIDES.length);
  };

  const currentSlide = HERO_SLIDES[activeIndex];

  return (
    <section
      aria-label="Featured Machinery Showcase"
      onMouseEnter={() => setPaused(true)}
      onMouseLeave={() => setPaused(false)}
      onFocus={() => setPaused(true)}
      onBlur={() => setPaused(false)}
      className="relative bg-[#131D54] overflow-hidden border-b-4 border-[#F2B705]"
    >
      {/* Slides Background Stack */}
      <div className="relative min-h-[480px] sm:min-h-[540px] lg:min-h-[580px] flex items-center">
        {HERO_SLIDES.map((slide, idx) => {
          const isActive = idx === activeIndex;
          const imgSrc = MEDIA_ASSETS[slide.imageKey];
          return (
            <div
              key={slide.id}
              aria-hidden={!isActive}
              className={`absolute inset-0 transition-opacity duration-700 ${
                isActive ? 'opacity-100 z-0' : 'opacity-0 -z-10 pointer-events-none'
              }`}
            >
              <img
                src={imgSrc}
                alt={slide.title}
                referrerPolicy="no-referrer"
                className="w-full h-full object-cover"
              />
              <div
                aria-hidden="true"
                className="absolute inset-0 bg-gradient-to-r from-[#0E1642]/95 via-[#131D54]/80 to-[#131D54]/30"
              />
            </div>
          );
        })}

        {/* Slide Foreground Content */}
        <div className="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 pt-12 pb-20 sm:py-20">
          <div className="max-w-2xl">
            <div className="flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs sm:text-sm font-semibold text-[#F2B705] mb-3">
              <span>{currentSlide.kicker}</span>
              <span aria-hidden="true" className="text-white/40">
                ·
              </span>
              <span className="text-slate-200">{currentSlide.partnerLabel}</span>
            </div>

            <h1 className="text-3xl sm:text-5xl lg:text-[54px] font-bold text-white leading-[1.1] tracking-tight text-balance">
              {currentSlide.title}
            </h1>

            <div
              aria-hidden="true"
              className="w-20 h-1 bg-[#F2B705] rounded-full my-5"
            />

            <p className="text-base sm:text-lg text-slate-200 leading-relaxed max-w-xl mb-8">
              {currentSlide.subtitle}
            </p>

            <div className="flex flex-wrap items-center gap-3.5">
              <button
                type="button"
                onClick={() =>
                  onNavigate(currentSlide.ctaTarget, currentSlide.ctaCategory)
                }
                className="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-[#131D54] bg-[#F2B705] hover:bg-[#D69E00] rounded-lg transition-colors cursor-pointer whitespace-nowrap"
              >
                <span>{currentSlide.ctaLabel}</span>
                <ArrowRight className="w-4 h-4" aria-hidden="true" />
              </button>

              <button
                type="button"
                onClick={() => onNavigate('contact')}
                className="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white border border-white/30 bg-white/10 hover:bg-white/20 rounded-lg backdrop-blur-xs transition-colors cursor-pointer whitespace-nowrap"
              >
                <span>Request Free Quote</span>
              </button>
            </div>
          </div>
        </div>

        {/* Prev / Next Controls */}
        <div className="flex items-center gap-2 absolute right-4 sm:right-6 bottom-5 sm:bottom-6 z-20">
          <button
            type="button"
            onClick={goPrev}
            aria-label="Previous hero slide"
            className="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#131D54]/85 hover:bg-[#1E2C7A] text-white border border-white/20 flex items-center justify-center transition-colors cursor-pointer"
          >
            <ChevronLeft className="w-4 h-4 sm:w-5 sm:h-5" aria-hidden="true" />
          </button>
          <button
            type="button"
            onClick={goNext}
            aria-label="Next hero slide"
            className="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#131D54]/85 hover:bg-[#1E2C7A] text-white border border-white/20 flex items-center justify-center transition-colors cursor-pointer"
          >
            <ChevronRight className="w-4 h-4 sm:w-5 sm:h-5" aria-hidden="true" />
          </button>
        </div>

        {/* Slide Indicators */}
        <div
          role="tablist"
          aria-label="Hero slide selectors"
          className="absolute left-4 sm:left-6 bottom-6 z-20 flex items-center gap-2"
        >
          {HERO_SLIDES.map((slide, idx) => {
            const isSelected = idx === activeIndex;
            return (
              <button
                key={slide.id}
                type="button"
                role="tab"
                aria-selected={isSelected}
                aria-label={`Slide ${idx + 1}: ${slide.kicker}`}
                onClick={() => setActiveIndex(idx)}
                className={`h-2 rounded-full transition-all cursor-pointer ${
                  isSelected
                    ? 'w-9 bg-[#F2B705]'
                    : 'w-2.5 bg-white/40 hover:bg-white/70'
                }`}
              />
            );
          })}
        </div>
      </div>
    </section>
  );
};
