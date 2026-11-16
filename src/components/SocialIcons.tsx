import React from 'react';
import { COMPANY_INFO } from '../data/siteData';

interface SocialIconsProps {
  variant?: 'light' | 'dark';
  size?: 'sm' | 'md';
}

export const SocialIcons: React.FC<SocialIconsProps> = ({
  variant = 'light',
  size = 'sm',
}) => {
  const iconSize = size === 'sm' ? 'w-4 h-4' : 'w-5 h-5';
  const btnClass =
    variant === 'light'
      ? 'text-slate-200 hover:text-[#F2B705] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#F2B705] rounded p-1 transition-colors'
      : 'text-slate-600 hover:text-[#1E2C7A] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1E2C7A] rounded p-1.5 bg-slate-100 hover:bg-slate-200 transition-colors';

  return (
    <div className="flex items-center gap-1.5">
      <a
        href={COMPANY_INFO.social[0].href}
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Serendib Tools on Facebook"
        className={btnClass}
      >
        <svg className={iconSize} viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.5 1.5-1.5h1.7V5c-.3 0-1.3-.1-2.5-.1-2.4 0-4.1 1.5-4.1 4.2V11H7.5v3h2.6v8h3.4z" />
        </svg>
      </a>
      <a
        href={COMPANY_INFO.social[1].href}
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Serendib Tools on X (Twitter)"
        className={btnClass}
      >
        <svg className={iconSize} viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
        </svg>
      </a>
      <a
        href={COMPANY_INFO.social[2].href}
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Serendib Tools on Instagram"
        className={btnClass}
      >
        <svg className={iconSize} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
          <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
          <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
          <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
        </svg>
      </a>
      <a
        href={COMPANY_INFO.social[3].href}
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Serendib Tools on LinkedIn"
        className={btnClass}
      >
        <svg className={iconSize} viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z" />
        </svg>
      </a>
      <a
        href={COMPANY_INFO.social[4].href}
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Serendib Tools on YouTube"
        className={btnClass}
      >
        <svg className={iconSize} viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
        </svg>
      </a>
    </div>
  );
};
