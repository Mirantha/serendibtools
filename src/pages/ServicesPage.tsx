import React from 'react';
import {
  Wrench,
  Hammer,
  Settings,
  Factory,
  Cpu,
  ShieldCheck,
  ArrowRight,
  CheckCircle2,
} from 'lucide-react';
import {
  SERVICES,
  type PageRoute,
  type ProductCategory,
} from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import { PageHeader } from '../components/PageHeader';
import { TrustBar, WhySerendibSection } from '../components/WhySerendibSection';

interface ServicesPageProps {
  onNavigate: (page: PageRoute, category?: ProductCategory) => void;
  onInquireService: (serviceTitle: string) => void;
}

const SERVICE_ICONS = [
  Wrench,
  Hammer,
  Settings,
  Factory,
  Cpu,
  ShieldCheck,
];

export const ServicesPage: React.FC<ServicesPageProps> = ({
  onNavigate,
  onInquireService,
}) => {
  return (
    <div>
      <PageHeader
        title="What We Offer"
        eyebrow="Serendib Engineering & Support Services"
        subtitle="Complete end-to-end solutions from machinery supply and installation to ongoing technical support and after-sales maintenance."
        imageSrc={MEDIA_ASSETS.bannerAboutFactory}
        imageAlt="Serendib Tools technician performing industrial saw service"
        onNavigateHome={() => onNavigate('home')}
        currentLabel="Services"
      />

      <TrustBar />

      {/* Authentic Service Banner Showcase from Original Site */}
      <section className="pt-12 pb-4 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-[#131D54]">
            <img
              src={MEDIA_ASSETS.serviceBanner}
              alt="Serendib — Reliable Support, Expert Care, Keeping Your Machinery Performing at Its Best"
              referrerPolicy="no-referrer"
              className="w-full h-auto object-cover"
            />
          </div>
        </div>
      </section>

      {/* 6 End-to-End Services Grid */}
      <section className="py-12 sm:py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {SERVICES.map((svc, idx) => {
              const Icon = SERVICE_ICONS[idx % SERVICE_ICONS.length];
              return (
                <article
                  key={svc.id}
                  className="bg-slate-50 border border-slate-200 rounded-xl p-6 flex flex-col justify-between hover:border-[#1E2C7A]/40 transition-colors"
                >
                  <div>
                    <div className="flex items-center justify-between mb-5">
                      <div className="w-11 h-11 rounded-xl bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center">
                        <Icon className="w-5 h-5" aria-hidden="true" />
                      </div>
                      <span className="font-mono text-sm font-bold text-slate-400 tabular-nums">
                        {svc.number}
                      </span>
                    </div>

                    <h2 className="text-lg font-bold text-slate-900 mb-2.5">
                      {svc.title}
                    </h2>

                    <p className="text-sm text-slate-600 leading-relaxed mb-5">
                      {svc.description}
                    </p>

                    <div className="flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs font-medium text-slate-700 mb-6">
                      {svc.capabilities.map((cap, capIdx) => (
                        <React.Fragment key={cap}>
                          {capIdx > 0 && (
                            <span aria-hidden="true" className="text-slate-300">
                              ·
                            </span>
                          )}
                          <span className="inline-flex items-center gap-1">
                            <CheckCircle2
                              className="w-3.5 h-3.5 text-[#1E2C7A]"
                              aria-hidden="true"
                            />
                            {cap}
                          </span>
                        </React.Fragment>
                      ))}
                    </div>
                  </div>

                  <div className="pt-4 border-t border-slate-200 flex items-center justify-between gap-3">
                    <button
                      type="button"
                      onClick={() => onInquireService(svc.title)}
                      className="inline-flex items-center gap-1.5 text-sm font-semibold text-[#1E2C7A] hover:text-[#131D54] cursor-pointer"
                    >
                      <span>Request Service</span>
                      <ArrowRight className="w-4 h-4" aria-hidden="true" />
                    </button>
                    {svc.categoryLink !== 'All' && (
                      <button
                        type="button"
                        onClick={() =>
                          onNavigate('products', svc.categoryLink as ProductCategory)
                        }
                        className="text-xs font-semibold text-slate-600 hover:text-[#1E2C7A] cursor-pointer"
                      >
                        View Equipment
                      </button>
                    )}
                  </div>
                </article>
              );
            })}
          </div>
        </div>
      </section>

      <WhySerendibSection />
    </div>
  );
};
