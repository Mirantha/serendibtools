import React from 'react';
import { ArrowRight, CheckCircle2 } from 'lucide-react';
import {
  ABOUT_CONTENT,
  PRODUCT_CATEGORIES,
  SERVICES,
  type PageRoute,
  type ProductCategory,
  type ProductItem,
} from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import { HeroSlider } from '../components/HeroSlider';
import { FeaturedSlider } from '../components/FeaturedSlider';
import { TrustBar, WhySerendibSection } from '../components/WhySerendibSection';

interface HomePageProps {
  onNavigate: (page: PageRoute, category?: ProductCategory) => void;
  onSelectProduct: (product: ProductItem) => void;
  onInquireProduct: (product: ProductItem) => void;
}

export const HomePage: React.FC<HomePageProps> = ({
  onNavigate,
  onSelectProduct,
  onInquireProduct,
}) => {
  return (
    <div>
      {/* 1. Primary Hero Multi-Slide Carousel */}
      <HeroSlider onNavigate={onNavigate} />

      {/* 2. Trust Guarantees Strip */}
      <TrustBar />

      {/* 3. Machinery Categories Quick Navigator */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
            <div>
              <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-2">
                Industrial Product Range
              </p>
              <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                Nine Specialized Machinery &amp; Tooling Divisions
              </h2>
            </div>
            <button
              type="button"
              onClick={() => onNavigate('products')}
              className="inline-flex items-center gap-1.5 text-sm font-semibold text-[#1E2C7A] hover:text-[#131D54] cursor-pointer whitespace-nowrap"
            >
              <span>Browse Complete Catalog</span>
              <ArrowRight className="w-4 h-4" aria-hidden="true" />
            </button>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {PRODUCT_CATEGORIES.map((category, idx) => (
              <button
                key={category}
                type="button"
                onClick={() => onNavigate('products', category)}
                className="group flex items-center justify-between p-5 bg-slate-50 hover:bg-[#1E2C7A] border border-slate-200 hover:border-[#1E2C7A] rounded-xl transition-colors cursor-pointer text-left"
              >
                <div>
                  <span className="block font-mono text-xs font-semibold text-slate-400 group-hover:text-[#F2B705] tabular-nums mb-1">
                    {String(idx + 1).padStart(2, '0')}
                  </span>
                  <span className="text-base font-bold text-slate-900 group-hover:text-white transition-colors">
                    {category}
                  </span>
                </div>
                <ArrowRight
                  className="w-4 h-4 text-slate-400 group-hover:text-[#F2B705] group-hover:translate-x-0.5 transition-all shrink-0"
                  aria-hidden="true"
                />
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* 4. Featured Machinery Carousel Slider */}
      <FeaturedSlider
        onSelectProduct={onSelectProduct}
        onInquireProduct={onInquireProduct}
        onViewAllProducts={() => onNavigate('products')}
      />

      {/* 5. About & Proof Split Section */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
            <div className="lg:col-span-6 flex flex-col justify-center">
              <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-2">
                {ABOUT_CONTENT.eyebrow}
              </p>
              <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-4 text-balance">
                {ABOUT_CONTENT.headline}
              </h2>
              <p className="text-sm sm:text-base text-slate-600 leading-relaxed mb-6">
                {ABOUT_CONTENT.experienceSummary}
              </p>

              <div className="grid grid-cols-2 gap-4 mb-8">
                {ABOUT_CONTENT.stats.slice(0, 2).map((stat) => (
                  <div
                    key={stat.label}
                    className="p-4 rounded-xl bg-slate-50 border border-slate-200"
                  >
                    <p className="text-3xl font-bold text-[#1E2C7A] tabular-nums">
                      {stat.value}
                    </p>
                    <p className="text-xs font-semibold text-slate-600 mt-1">
                      {stat.label}
                    </p>
                  </div>
                ))}
              </div>

              <div className="flex flex-wrap items-center gap-3">
                <button
                  type="button"
                  onClick={() => onNavigate('about')}
                  className="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-[#1E2C7A] hover:bg-[#131D54] rounded-lg transition-colors cursor-pointer whitespace-nowrap"
                >
                  <span>Our Company Story</span>
                  <ArrowRight className="w-4 h-4" aria-hidden="true" />
                </button>
                <button
                  type="button"
                  onClick={() => onNavigate('services')}
                  className="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors cursor-pointer whitespace-nowrap"
                >
                  <span>Explore Services</span>
                </button>
              </div>
            </div>

            <div className="lg:col-span-6">
              <div className="h-full min-h-[320px] rounded-2xl overflow-hidden border border-slate-200 bg-slate-100">
                <img
                  src={MEDIA_ASSETS.aboutVision}
                  alt="Serendib Tools certified machinery engineering and global brand network"
                  referrerPolicy="no-referrer"
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 6. Services Snapshot */}
      <section className="py-16 bg-[#131D54] text-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
            <div>
              <p className="text-xs font-semibold uppercase tracking-wider text-[#F2B705] mb-2">
                What We Offer
              </p>
              <h2 className="text-2xl sm:text-3xl font-bold tracking-tight">
                End-to-End Supply, Setup &amp; Maintenance
              </h2>
            </div>
            <button
              type="button"
              onClick={() => onNavigate('services')}
              className="inline-flex items-center gap-1.5 text-sm font-semibold text-[#F2B705] hover:underline cursor-pointer whitespace-nowrap"
            >
              <span>All 6 Services</span>
              <ArrowRight className="w-4 h-4" aria-hidden="true" />
            </button>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {SERVICES.map((svc) => (
              <div
                key={svc.id}
                className="p-6 rounded-xl bg-white/6 border border-white/12 hover:border-[#F2B705]/60 transition-colors flex flex-col"
              >
                <span className="font-mono text-xs font-semibold text-[#F2B705] tabular-nums mb-2">
                  {svc.number}.
                </span>
                <h3 className="text-lg font-bold text-white mb-2">
                  {svc.title}
                </h3>
                <p className="text-sm text-slate-300 leading-relaxed mb-4 flex-1">
                  {svc.description}
                </p>
                <div className="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-300 pt-3 border-t border-white/10">
                  {svc.capabilities.map((cap, i) => (
                    <React.Fragment key={cap}>
                      {i > 0 && (
                        <span aria-hidden="true" className="text-white/30">
                          ·
                        </span>
                      )}
                      <span className="inline-flex items-center gap-1">
                        <CheckCircle2
                          className="w-3 h-3 text-[#F2B705]"
                          aria-hidden="true"
                        />
                        {cap}
                      </span>
                    </React.Fragment>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 7. Why Clients Choose Us */}
      <WhySerendibSection />
    </div>
  );
};
