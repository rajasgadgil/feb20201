var $ = jQuery.noConflict();
jQuery(document).ready(function($) {
    var siteUrl = $('meta[name="site_url"]').attr('content') ? $('meta[name="site_url"]').attr('content') : "";
    var app = {
        xhrs: {},
        base_api: `${siteUrl}/wp-json/wp/v2`
    };

    app.utils = (function() {
        function parseQueryParams(url) {
            var params = {};
            var parser = document.createElement('a');
            parser.href = url;
            var query = parser.search.substring(1);
            var vars = query.split('&');
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split('=');
                params[pair[0]] = decodeURIComponent(pair[1]);
            }
            return params;
        };

        function formatDate(date) {
            var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'Novenber', 'December'];
            var d = new Date(date),
                month = '' + d.getMonth(),
                day = '' + d.getDate(),
                year = d.getFullYear();

            // if (month.length < 2)
            //     month = '0' + month;
            // if (day.length < 2)
            //     day = '0' + day;

            return `${monthNames[month]} ${day}, ${year}`;
            // return [month, day, year].join('/');
        }

        function getApiCall(url = "/", queryParams = {}, body = {}, name = "search") {
            return new Promise((resolve, reject) => {
                if (app.xhrs[name] !== undefined && app.xhrs[name] !== null) {
                    app.xhrs[name].abort();
                }

                var params = [];
                if (queryParams.constructor === Object && Object.keys(queryParams).length > 0) {
                    for (var key in queryParams) {
                        if (queryParams[key] != "undefined") {
                            params.push(key + '=' + queryParams[key]);
                        }
                    }
                }

                var apiUrl = `${app.base_api}${url}?${params.length > 0 ? params.join('&') : ""}`;

                app.xhrs[name] = $.post({
                    url: apiUrl,
                    data: JSON.stringify(body),
                    dataType: "json",
                    contentType: 'application/json; charset=utf-8',
                }).done(function(data) {
                    resolve(data);
                }).fail(function(error) {
                    reject(error)
                }).always(function() {
                    app.xhrs[name] = null;
                });
            });
        }
		
		function newGetApiCall(url = "/", queryParams = {}, filters = {}, name = "search") {
            return new Promise((resolve, reject) => {
                if (app.xhrs[name] !== undefined && app.xhrs[name] !== null) {
                    app.xhrs[name].abort();
                }

                var params = [];
                if (queryParams.constructor === Object && Object.keys(queryParams).length > 0) {
                    for (var key in queryParams) {
                        if (queryParams[key] != "undefined") {
                            params.push(key + '=' + queryParams[key]);
                        }
                    }
                }

                var apiUrl = `${app.base_api}${url}?_embed${params.length > 0 ? "&" + params.join('&') : ""}`;

                if(filters && (filters.business_sectors || filters.domains || filters.functions)) {
                  apiUrl = apiUrl + '&';
    
                  if(filters.business_sectors && filters.business_sectors.length > 0) {
                    for(const id of filters.business_sectors) {
                      apiUrl = apiUrl + 'business_sector[]=' + id + '&';
                    }
                  }
    
                  if(filters.domains) {
                    for(const id of filters.domains) {
                      apiUrl = apiUrl + 'domain[]=' + id + '&';
                    }
                  }
    
                  if(filters.functions) {
                    for(const id of filters.functions) {
                      apiUrl = apiUrl + 'functions[]=' + id + '&';
                    }
                  }

                  apiUrl = apiUrl.substr(0, apiUrl.length - 1);
                }

                app.xhrs[name] = $.get({
                    url: apiUrl,
                    dataType: "json",
                    contentType: 'application/json; charset=utf-8',
                }).done(function(data, status, req) {
                    resolve({ data, totalPosts: req.getResponseHeader('X-WP-Total'), totalPages: req.getResponseHeader('X-WP-TotalPages') });
                }).fail(function(error) {
                    resolve(null)
                }).always(function() {
                    app.xhrs[name] = null;
                });
            });
        }

        return {
            parseQueryParams,
            getApiCall,
            formatDate,
			      newGetApiCall
        };
    })($);

    app.search = (function() {
        var cache = {};
        var activeTab = "all";
        var activeSubTab = null;
        var preloader = `<div class="loading-overlay">
          <div class="loading">
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
          </div>
        </div>`;
        var noResult = `<div class="card document no-result">
          <div class="card-body py-4 px-4">
            <div class="w-100 text-center">
              <h3 class="text-dark document-title text-center p-0 mt-0 mb-5 mx-0">No Result Found</h3>
            </div>
          </div>
        </div>`;

        function init() {
            cacheSelectors();

            cache.$documentTabs.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                cache.$documentTabs.removeClass('active');
                $(this).addClass('active');
                var target = $(this).attr('href');
                const dataTab = $(this).attr('data-tab') ? $(this).attr('data-tab') : null;
                
                if(dataTab !== activeTab) {
                  activeTab = dataTab;
                  cache.$documentPanels.fadeOut('fast', function() {
                    setTimeout(function() {
                        $('.search--page .document-type-panels .document-type-panel' + target + '-panel').fadeIn('fast');
                    }, 200);
                  });
                  search(1, "/" + dataTab);
                }
            });

            cache.$filters.children('.filter-title').on('click', function() {
                var _this = $(this);
                _this.parent().toggleClass("collapsed");
                _this.parent().find('.filter--body').slideToggle('fast');
            });

            cache.$filterApplyBtn.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                search(1, "/" + activeTab);
            });

            cache.$filterClrBtn.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                clearFilters();
                search(1, "/" + activeTab);
            });

            cache.$searchBtn.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                search(1, "/" + activeTab);
            });

            cache.$searchInput.on('keypress', function(e) {
                if (e.which == 13) {
                  search(1, "/" + activeTab);
                  return false;
                }
            });

            cache.$filtersHeader.on('click', function() {
              cache.$filters.slideToggle('fast');
              cache.$filtersFooter.slideToggle('fast');
            });

            $( window ).resize(function() {
              if (window.matchMedia('(min-width: 768px)').matches) {
                cache.$filters.slideDown('fast');
                cache.$filtersFooter.slideDown('fast');
              }
            });

            $(document).on('click', '.search--page .search--body .document-type-panels .document-type-panel .panel-footer ul.pages li', function() {
              if($(this).hasClass('active')) {
                return false;
              }
              search($(this).attr('data-page'), "/" + activeTab);
            });

            $(document).on('click', '.search--page .search--body .search--results .document-type-panel .panel-header ul.document-sub-type-tabs li a', function(e) {
              e.preventDefault();
              e.stopPropagation();
              if($(this).hasClass('active')) {
                return false;
              }
              $('.search--page .search--body .search--results .document-type-panel .panel-header ul.document-sub-type-tabs li a').removeClass('active');
              $(this).addClass('active');

              activeSubTab = $(this).attr('data-tab') ? $(this).attr('data-tab') : "all";
              
              search();
            });

            search();
        }

        function cacheSelectors() {
            cache = {
                $page: $(".search--page"),
                $documentTabs: $(".search--page .document-type-tabs li a"),
                $documentPanels: $(".search--page .document-type-panels .document-type-panel"),
                $searchResultCount: $(".search--page .search-filters span.item-count span"),
                $filtersHeader: $(".search--page .search--body .search--filters .filter--header"),
                $filters: $(".search--page .search--body .search--filters .filter--wrapper"),
                $filtersFooter: $(".search--page .search--body .search--filters .filter--footer"),
                $filterApplyBtn: $(".search--page .search--filters .filter--footer button.apply--btn"),
                $filterClrBtn: $(".search--page .search--filters .filter--footer button.clear--btn"),
                $searchInput: $(".search--page input[name='search-input']"),
                $searchBtn: $(".search--page button.search--btn"),
                $searchedTerm: $(".search--page .searched-term"),
                $totalResult: $(".search--page .total--result span.total--result-count")
            };
        }

        async function search(page = 1, endpoint = "/all") {
            var $resultContainer = getActiveContainer();
            var params = ((cache.$searchInput.val()).trim()).length > 0 ? { search: (cache.$searchInput.val()).trim() } : app.utils.parseQueryParams(window.location.href);
            params['page'] = page;
            // if(activeTab !== null) {
            //   params.doc_type = activeTab;
            // }
            // if(activeTab === 'article' && activeSubTab && activeSubTab !== 'all') {
            //   params.doc_sub_type = activeSubTab;
            // }
            // params.page = page;
            var filters = getFilters();

            cache.$searchedTerm.text(params.search ? params.search : "");

            try {
                $resultContainer.children('.panel-body').html(preloader);
                let results = [];
                if(endpoint === "/all") {
                  const articles = await app.utils.newGetApiCall("/article", params, filters, 'search');
                  const events = await app.utils.newGetApiCall("/event", params, filters, 'search');
                  const news = await app.utils.newGetApiCall("/news", params, filters, 'search');
                  const articlePosts = articles ? Number(articles.totalPosts) : 0;
                  const eventsPosts = events ? Number(events.totalPosts) : 0
                  const newsPosts = news ? Number(news.totalPosts) : 0
                  const totalPosts = (articles ? Number(articles.totalPosts) : 0) + (events ? Number(events.totalPosts) : 0) + (news ? Number(news.totalPosts) : 0);
                  const max = articlePosts > eventsPosts ? ( articlePosts > newsPosts ? articlePosts : newsPosts) : (eventsPosts > newsPosts ? eventsPosts : newsPosts);
                  let data = articles ? articles.data : [];
                  if(events) {
                    data = data.concat(events.data);
                  }

                  if(news) {
                    data = data.concat(news.data);
                  }

                  results = { data, currentPage: page,
                    totalPosts, 
                    totalPages: Math.ceil(max / 10)
                  }
                }
                else {
                  results = await app.utils.newGetApiCall(endpoint, params, filters, 'search');
                  results['currentPage'] = page;
                }
                
                showDynamicFilters(results.data);
                renderResults(results);
            } catch (error) {
                console.log(error);
            }
        }

        function showDynamicFilters(data) {
          const business_sector_ids = {};
          const domain_ids = {};
          const function_ids = {};
          if(data.length > 0) {
            for(const post of data) {
              if(post.business_sector && post.business_sector.length > 0) {
                post.business_sector.forEach(val => {
                  business_sector_ids[val] = 1;
                });
              }

              if(post.domain && post.domain.length > 0) {
                post.domain.forEach(val => {
                  domain_ids[val] = 1;
                });
              }

              if(post.functions && post.functions.length > 0) {
                post.functions.forEach(val => {
                  function_ids[val] = 1;
                });
              }
            }
          }

          // Remove business_sector filter not in response data
          const bsLis = $('.search--page .search--body .search--filters .filter--wrapper .filter--body #ul-business_sector li');
          if(bsLis.length > 0) {
            bsLis.each(function() {
              const id = $(this)[0].id;
              const splitIds = id.split('-');
              if(!(business_sector_ids[Number(splitIds[2])])) {
                $(this).addClass('d-none');
              }
              else {
                $(this).removeClass('d-none');
              }
            });
          }

          // Remove domain filter not in response data
          const dLis = $('.search--page .search--body .search--filters .filter--wrapper .filter--body #ul-domain li');
          if(dLis.length > 0) {
            dLis.each(function() {
              const id = $(this)[0].id;
              const splitIds = id.split('-');
              if(!domain_ids[Number(splitIds[2])]) {
                $(this).addClass('d-none');
              }
              else {
                $(this).removeClass('d-none');
              }
            });
          }

          // Remove functions filter not in response data
          const fLis = $('.search--page .search--body .search--filters .filter--wrapper .filter--body #ul-functions li');
          if(fLis.length > 0) {
            fLis.each(function() {
              const id = $(this)[0].id;
              const splitIds = id.split('-');
              if(!function_ids[Number(splitIds[2])]) {
                $(this).addClass('d-none');
              }
              else {
                $(this).removeClass('d-none');
              }
            });
          }
        }

        function getFilters() {
            var filters = {};
            cache.$filters.each(function() {
                var _this = $(this);
                var filterName = _this.attr('data-filter');
                var $checked = _this.find(".filter--body ul li input[type='checkbox']:checked");
                var ids = [];
                if ($checked.length > 0) {
                    $checked.each(function() {
                        var val = Number($(this)[0].value);
                        if (val > 0) {
                            ids.push(val)
                        }
                    });
                }
                if (ids.length > 0) {
                    filters[filterName] = ids;
                }
            });

            return filters;
        }

        function clearFilters() {
            cache.$filters.each(function() {
                var _this = $(this);
                var $checked = _this.find(".filter--body ul li input[type='checkbox']:checked");
                if ($checked.length > 0) {
                    $checked.each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });
        }

        function getActiveContainer() {
          var containerIds = {
            all: 'all',
            article: 'articles',
            event: 'events',
            software: 'softwares',
            news: 'news',
            company: 'companies'
          }
          return $(`.search--page .search--body .search--results .document-type-panels .document-type-panel#${containerIds[activeTab ? activeTab : 'all']}-panel`);
        }

        function renderResults(results) {
          var $resultContainer = getActiveContainer();
          var rows = [];
          cache.$totalResult.text(`${Number(results.totalPosts)}`);
          if (results.data.length > 0) {
              results.data.forEach((post) => {
                  const postImg = post.featured_media && post._embedded && post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia'][0] && post._embedded['wp:featuredmedia'][0].media_details
                    && post._embedded['wp:featuredmedia'][0].media_details.sizes && post._embedded['wp:featuredmedia'][0].media_details.sizes.thumbnail ? 
                    post._embedded['wp:featuredmedia'][0].media_details.sizes.thumbnail.source_url : 'https://aeon2.blvckpixel.com/wp-content/uploads/2020/12/stock3-1030x773-1-80x80.jpg';
                  const postAuthor = post._embedded && post._embedded.author && post._embedded.author[0] ? post._embedded.author[0].name + ' | ' : '';
                  var row = `
                  <div class="card mb-4">
                    <div class="card-body pt-0 pb-4 px-0">
                      <div class="d-flex align-items-center justify-content-center">
                        <img src="${postImg}" class="feat-img" alt="${post.title}" />
                      </div>
                      <div class="hc-lh-sm ml-3 ml-lg-0">
                        <a href="${post.link}">
                          <h3 class="m-0 hc-fs-36 hc-fw-700 hc-color-primary">
                            ${post.title.rendered}
                          </h3>
                        </a>
                        <span class="hc-fs-18 hc-fw-400">${postAuthor}${app.utils.formatDate(post.modified)}</span>
                      </div>
                      <div class="d-block d-lg-none">
                        <p class="card-text my-4 hc-lh-base">${post.content.rendered}</p>
                        <div>
                          <span class="hc-fs-18 text-uppercase">
                            <span class="hc-color-secondary">${post.business_sector && post.business_sector.length > 0 ? post.business_sector.join(", ") : ''}</span> / <span>${post.type}</span> / <span>${post.domain && post.domain.length > 0 ? post.domain.join(", ") : ''}</span>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                `;

                rows.push(row);
              });
          }
          $resultContainer.children('.panel-body').html(rows.length > 0 ? rows.join("") : noResult);
          $resultContainer.find('.panel-footer span.total').html(`Page ${Number(results.totalPages) > 0 ? results.currentPage : 0}/${results.totalPages}`);

          var $pages = [];
          if(Number(results.totalPages) > 1) {
            for(var i=1; i<=results.totalPages; i++) {
              $pages.push(`
                <li class="${i == results.currentPage ? 'active' : ''}" data-page="${i}">${i}</li>
              `)
            }
          }
          $resultContainer.find('.panel-footer ul.pages').html($pages.join(""));
        }

        return {
            init: init,
            search: search
        };
    })($);

    app.search.init();
});