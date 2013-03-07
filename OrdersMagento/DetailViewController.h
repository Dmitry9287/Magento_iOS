//
//  DetailViewController.h
//  OrdersMagento
//
//  Created by Jose on 06/03/13.
//  Copyright (c) 2013 Devopensource. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface DetailViewController : UIViewController

@property (strong, nonatomic) id detailItem;

@property (weak, nonatomic) IBOutlet UILabel *detailDescriptionLabel;
@end
