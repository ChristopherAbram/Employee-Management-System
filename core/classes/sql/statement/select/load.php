<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load select package
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

require_once realpath( dirname(__FILE__).'/Statement.class.php' );

require_once realpath( dirname(__FILE__).'/Blank.class.php' );
require_once realpath( dirname(__FILE__).'/Address.class.php' );
require_once realpath( dirname(__FILE__).'/Country.class.php' );
require_once realpath( dirname(__FILE__).'/AllCountries.class.php' );
require_once realpath( dirname(__FILE__).'/UserRole.class.php' );
require_once realpath( dirname(__FILE__).'/User.class.php' );

require_once realpath( dirname(__FILE__).'/Page.class.php' );
require_once realpath( dirname(__FILE__).'/PageArticle.class.php' );
require_once realpath( dirname(__FILE__).'/PageArticleByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/PageVisit.class.php' );
require_once realpath( dirname(__FILE__).'/PageVisitCount.class.php' );
require_once realpath( dirname(__FILE__).'/PageVisitCountByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/PageByChildPageId.class.php' );
require_once realpath( dirname(__FILE__).'/PageByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/PageByArticleIdAndByBin.class.php' );
require_once realpath( dirname(__FILE__).'/PageByArticleIdByBinAndByHide.class.php' );
require_once realpath( dirname(__FILE__).'/PageByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/AllPageByPublicistIdAndByBin.class.php' );
require_once realpath( dirname(__FILE__).'/PageByParentPageId.class.php' );
require_once realpath( dirname(__FILE__).'/PageByParentPageIdAndByBin.class.php' );
require_once realpath( dirname(__FILE__).'/PageByParentPageIdByBinAndByHide.class.php' );
require_once realpath( dirname(__FILE__).'/PageByNamepath.class.php' );
require_once realpath( dirname(__FILE__).'/PageHavingAnyArticles.class.php' );
require_once realpath( dirname(__FILE__).'/PageHavingAnyArticlesforPublicist.class.php' );
require_once realpath( dirname(__FILE__).'/RemovedPages.class.php' );
require_once realpath( dirname(__FILE__).'/UserPage.class.php' );
require_once realpath( dirname(__FILE__).'/UserPageByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/UserPageByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/UnremovedPageById.class.php' );
require_once realpath( dirname(__FILE__).'/CountPage.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedPage.class.php' );
require_once realpath( dirname(__FILE__).'/CountPageHavingAnyArticles.class.php' );
require_once realpath( dirname(__FILE__).'/CountPageHavingAnyArticlesforPublicist.class.php' );

require_once realpath( dirname(__FILE__).'/Article.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleVisit.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleVisitCount.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleVisitCountByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGrade.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGradeCount.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGradeCountByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGradeCountByUserAndArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGradeByUserAndArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGradeAverage.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGradeAverageByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByCommentId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByPageIdAndByBin.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByUserIdAndByBin.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByPageIdByUserIdAndByBin.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByPageIdByBinAndByHide.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByNamepath.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleByNamepathAndByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/RemovedArticleByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/RemovedArticles.class.php' );
require_once realpath( dirname(__FILE__).'/AllArticleSortedByCdate.class.php' );
require_once realpath( dirname(__FILE__).'/AllArticleSortedByCdateNotHiddenAndNotRemoved.class.php' );
require_once realpath( dirname(__FILE__).'/AllArticleSortedNotHiddenAndNotRemovedByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/CountArticle.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedArticle.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedArticleByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedArticleByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedArticleByPageIdAndByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedAndNotHiddenArticle.class.php' );
require_once realpath( dirname(__FILE__).'/CountNotRemovedAndNotHiddenArticleByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleCountByPageId.class.php' );

require_once realpath( dirname(__FILE__).'/Comment.class.php' );
require_once realpath( dirname(__FILE__).'/CommentByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/CommentByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/NotHiddenAndNotRemovedCommentByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/FileInfo.class.php' );
require_once realpath( dirname(__FILE__).'/NotRemovedFileInfo.class.php' );
require_once realpath( dirname(__FILE__).'/FileCount.class.php' );
require_once realpath( dirname(__FILE__).'/NotRemovedFileCount.class.php' );
require_once realpath( dirname(__FILE__).'/FileCountByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/ImageCountByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/NotRemovedFileCountByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/FileMiniature.class.php' );
require_once realpath( dirname(__FILE__).'/File.class.php' );
require_once realpath( dirname(__FILE__).'/CountryByAddressId.class.php' );
require_once realpath( dirname(__FILE__).'/CountryByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/AddressByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/UserRoleByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/UserByPageId.class.php' );
require_once realpath( dirname(__FILE__).'/UserByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/UserByCommentId.class.php' );
require_once realpath( dirname(__FILE__).'/UserByFileInfoId.class.php' );
require_once realpath( dirname(__FILE__).'/UserByIdentifiers.class.php' );
require_once realpath( dirname(__FILE__).'/UserByToken.class.php' );
require_once realpath( dirname(__FILE__).'/RemovedUsers.class.php' );
require_once realpath( dirname(__FILE__).'/AllUsersNotRemoved.class.php' );
require_once realpath( dirname(__FILE__).'/NotRemovedUserCount.class.php' );
require_once realpath( dirname(__FILE__).'/AvatarByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/FileInfoByFileId.class.php' );
require_once realpath( dirname(__FILE__).'/FileInfoByArticleId.class.php' );
require_once realpath( dirname(__FILE__).'/FileInfoByFileMiniatureId.class.php' );
require_once realpath( dirname(__FILE__).'/FileInfoByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/RemovedFileByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/RemovedFiles.class.php' );
require_once realpath( dirname(__FILE__).'/ImageFileInfoByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/NotRemovedFileInfoByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/FileMiniatureByFileInfoId.class.php' );
require_once realpath( dirname(__FILE__).'/FileByFileInfoId.class.php' );
require_once realpath( dirname(__FILE__).'/EmailExistance.class.php' );

require_once realpath( dirname(__FILE__).'/Session.class.php' );
require_once realpath( dirname(__FILE__).'/SessionBySID.class.php' );
require_once realpath( dirname(__FILE__).'/SessionValue.class.php' );
require_once realpath( dirname(__FILE__).'/SessionValueByKey.class.php' );
require_once realpath( dirname(__FILE__).'/SessionValueBySessionId.class.php' );


require_once realpath( dirname(__FILE__).'/Department.class.php' );